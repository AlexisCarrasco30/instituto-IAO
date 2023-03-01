<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Profesion;
use App\Models\Telefono;

class InscripcionController extends Controller
{
    /**
     * Se traen todas las incripciones
     *
     * @return \Illuminate\Http\Response
     */
    public function Incripciones()
    {
        $incripciones = Incripcion::where('estado','activo')
                                  ->orderBy('fecha','Desc')
                                  ->get();
    
        return view('inscripcion.inscripciones')
                  ->with('inscripciones', $inscripciones);
    }

    /**
     * Listado de incripciones ordenadas por creacion o actualizacion
     *
     * @return \Illuminate\Http\Response
     */
    public function IncripcionesUltimas()
    {
        $incripciones = Incripcion::where('estado','activo')
                                  ->orderBy('updated_at','Desc')
                                  ->get();
    
        return view('inscripcion.inscripciones')
                  ->with('inscripciones', $inscripciones);
    }

    /**
     * Realizar una inscripcion
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateInscripcion()
    { 
    //Traigo todas las Profesiones activas para que usuario lo pueda selecionar
        $profesiones = Profesion::where('estado','activo')
                                ->get();
        return view('inscripcion.create')
                  ->with('profesiones', $profesiones);
    }

    /**
     * Guardar inscripcion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreInscripcion(Request $request)
    {
        //Control de inputs
        $request->validate([
            //instituto
            'fecha'                => 'required|date',
            'matricula'            => 'required|string',
            'modalidad'            => 'required|string',
            'descripcionAdicional' => 'required|string',
            //alumno
            'nombre'               => 'required|string',
            'apellido'             => 'required|string',
            'dni'                  => 'required|integer|max:100000000|min:1000000',
            'fechaNacimiento'      => 'date',
            'calle'                => 'required|string|max:256| min:4',
            'numeroCalle'          => 'required|integer|min:1|max:9999',
            'codigoArea'           => 'required|numeric|max:9999|min:99',
            'numero'               => 'required|numeric|max:9999999|min:999999', 
            'whatsapp'             => 'required|boolean',
            //profesion
            'idProfesion'          => 'integer',
        ]);

    //Control de que se ha seleccionado una profesion
        $profesion = Profesion::find($request->idProfesion);

        if($profesion->isEmpty()){
            return redirect(url()->previuos());
        }

        $alumno = Alumno::Where('dni',$request->dni)
                        ->get();

        if($alumno->isEmpty()){
            $alumno = new Alumno();
        }else{
            if($alumno->estado == 'inactivo'){
                return redirect(url()->previuos());
            }
            else{
                //para que no me quede en forma de arreglo
                $alumno = Alumno::find($alumno->id);
            }
        } 
    //incersion de datos y guardado de alumno 
        $alumno->dni             = $request->dni;
        $alumno->nombre          = $request->nombre;
        $alumno->apellido        = $request->apellido;
        $alumno->numeroCalle     = $request->numeroCalle;
        $alumno->calle           = $request->calle;
        $alumno->fechaNacimiento = $request->fechaNacimiento;
        $alumno->estado          = "activo";
        $alumno->tipo            = "alumno";
        $alumno->save();

        //cambio de estado del numero que esta asignado para whatsapp
        if($request->whatsapp == true){
            $telefonoWhatsapp = Telefono::where('persona_id',$alumno->id)
                                        ->where('whatsapp','true')
                                        ->get();

            $telefonoWhatsapp->whatsapp = false;
            $telefonoWhatsapp->save();
         }
        
       //Busco el telefono
        $telefono = Telefono::where('codigoArea',$request->codigoArea)
                            ->where('numero'    ,$request->numero)
                            ->where('idPersona' ,$alumno->id)
                            ->get();

       //Si no la encuentro creo un
        if($telefono->isEmpty()){

            $telefono = new Telefono();
        }
        else{
           //para que no me quede en forma de arreglo
            $telefono = Telefono::find($telefono[0]->id);
            }

       //incersion de datos de telefono
        $telefono->codigoArea = $request->codigoArea;
        $telefono->numero     = $request->numero;
        $telefono->whatsapp   = $request->whatsapp;
        $telefono->persona_id = $alumno->id;
        $telefono->save();

       //incersion de datos y guardado de inscripcion
        $inscripcion                       = new Inscripcion();
        $inscripcion->matriculo            = $request->matricula;
        $inscripcion->modalidad            = $request->modalidad;
        $inscripcion->descripcionAdicional = $request->descripcionAdicional;
        $inscripcion->estado               = 'activo';
        $inscripcion->idAlumno             = $alumno->id;
        $inscripcion->idProfesion          = $profesion->id;
        $inscripcion->save();

        return redirect('/Inscripciones/Ultimas');
    }

    /**
     * Edicion de una incripcion.
     * @param  int  $id
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function EditInscripcion(Inscripcion $inscripcion,$id)
    {
        //Control de que exita la inscripcion activa
        $inscripcion = Inscripcion::where('id',$id)
                                  ->where('estado','activo')
                                  ->get();
        //traigo todas las profeciones para el select
        $profesiones = profesion::where('estado','activo')
                                ->get();                        
        
        return view('inscripcion.edit')
                  ->with('inscripcion', $inscripcion)
                  ->with('profesiones', $profesiones);
    }

    /**
     * Actualizacion de inscripcion.
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function UpdateInscripcion(Request $request, $id)
    {
      //Control de inputs
      $request->validate([
        //instituto
        'fecha'                => 'required|date',
        'matricula'            => 'required|string',
        'modalidad'            => 'required|string',
        'descripcionAdicional' => 'required|string',
        //alumno
        'nombre'               => 'required|string',
        'apellido'             => 'required|string',
        'dni'                  => 'required|integer|max:100000000|min:1000000',
        'fechaNacimiento'      => 'date',
        'calle'                => 'required|string|max:256| min:4',
        'numeroCalle'          => 'required|integer|min:1|max:9999',
        'codigoArea'           => 'required|numeric|max:9999|min:99',
        'numero'               => 'required|numeric|max:9999999|min:999999', 
        'whatsapp'             => 'required|boolean',
        //profesion
        'idProfesion'          => 'integer',
        ]);

    //control de que se ha selecionado una profesion   
        $profesion = Profesion::find($request->idProfesion);

        if($profesion->isEmpty()){
            return redirect(url()->previuos());
        }

        $alumno = Alumno::Where('dni',$request->dni)
                        ->get();

        if($alumno->isEmpty()){
            return redirect(url()->previuos());
        }else{
            if($alumno->estado == 'inactivo'){
                return redirect(url()->previuos());
            }
            else{
                //para que no me quede en forma de arreglo
                $alumno = Alumno::find($alumno->id);
            }
        } 
    //Incersion de datos y guardado de inscripcion
        $inscripcion                       = incripcion::find($id);
        $inscripcion->matriculo            = $request->matricula;
        $inscripcion->modalidad            = $request->modalidad;
        $inscripcion->descripcionAdicional = $request->descripcionAdicional;
        $inscripcion->estado               = 'activo';
        $inscripcion->idAlumno             = $alumno->id;
        $inscripcion->idProfesion          = $profesion->id;
        $inscripcion->save();

        return redirect('/Inscripciones/Ultimas');

    }

    /**
     * Baja de una incripcion
     * @param  int  $id
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function BajaIncripcion(Inscripcion $inscripcion , $id)
    {
        $inscripcion = inscripcion::find($id);
        $inscripcion->delete();

        return redirect('/Inscripciones/TodasIncripciones');
    }

     /**
      * Busqueda de profeciones inscritas por dni (ajax) 
      *
      * @param  \Illuminate\Http\Request  $request 
      * @return \Illuminate\Http\Response
      */
      public function BuscarProfesionIncriptasDni(Request  $request)
      {  
        //Busco al alumno
        $alumno = Persona::where('dni',$request->dni)
                         ->where('estado','activo')
                         ->get();
         //Si esta vacia defino profesion en null
         if ($alumno->isEmpty()){
             $profesion = null;
             return response(json_encode($profesion),200)->header('Content-type','text/plain');
         }

         $profesion = Profesion::join('incripciones','incripciones.idPofesion','=','profesion.id')
                               ->join('personas',    'personas.id'            ,'=','incripciones.idAlumno')
                               ->where('personas.tipo','alumno')
                               ->where('personas.id',$alumno->id)
                               ->get();
                               
         if ($profesion->isEmpty()){
            $profesion = null;
         }
        return response(json_encode($profesion),200)->header('Content-type','text/plain');
      }
}
