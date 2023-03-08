<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\Telefono;
use App\Models\Tutor;
use App\Models\Inscripcion;
use App\Models\Profesion;
use App\Models\Pago;
use App\Models\ClasificacionAlumno;
use App\Models\Notificacion_Moroso;
use App\Models\Examen;
use App\Models\User;


class PersonaController extends Controller
{
//------------------------------------------------------------------------
    /**
     * Se trae todos los alumnos que estan activos.
     *
     * @return \Illuminate\Http\Response
     */
    public function AlumnosActivos()
    { 
        $tipoAlumno = 'activos';
        $alumnos = Persona::select('personas.*','telefonos.numero')
                           ->where('personas.tipo','alumno')
                           ->where('personas.estado','activo')
                           ->leftjoin('telefonos','telefonos.idPersona','=','personas.id')
                           ->orderBy('apellido','Asc')
                           ->get();
     
        $clasificacion  = ClasificacionAlumno::all(); 
        
        return view ('alumno.activos')
                  ->with('alumnos',$alumnos)
                  ->with('tipoAlumno',$tipoAlumno)
                  ->with('clasificacion',$clasificacion); 
    }
//------------------------------------------------------------------------
/**
     * Se trae todos los alumnos corporativos que esten activos.
     *
     * @return \Illuminate\Http\Response
     */
    public function AlumnosCorporativos()
    {
        $tipoalumno = 'corporativo';
        $alumnos    = Persona::where('tipo','alumnoCorporativo')
                             ->where('estado','activo')
                                ->join('incripciones','incripciones.idAlumno','=','alumnos.id')
                                ->join('profesiones','profesiones.tipo','=','incripciones.idProfesion')
                             ->orderBy('apellido','Asc')
                             ->get();

        $clasificacion  = ClasificacionAlumno::all(); 

        return view ('alumno.activos')
                  ->with('alumnos',$alumnos)
                  ->with('tipoalumno',$tipoalumno)
                  ->with('clasificacion',$clasificacion);  

    }
//------------------------------------------------------------------------
/**
     * Se trae todos los alumnos secundaria que esten activos.
     *
     * @return \Illuminate\Http\Response
     */
    public function AlumnosSecundaria()
    {
        $tipoalumno = 'secundaria';
        $alumnos    = Persona::where('tipo','alumno')
                             ->where('estado','activo')
                                ->join('incripciones','incripciones.idAlumno','=','alumnos.id')
                                ->join('profesiones','profesiones.tipo','=','incripciones.idProfesion')
                             ->where('profesiones.tipo','=','secundaria')
                             ->orderBy('apellido','Asc')
                             ->get();

        $clasificacion  = ClasificacionAlumno::all(); 

        return view ('alumno.activos')
                  ->with('alumnos',$alumnos)
                  ->with('tipoalumno',$tipoalumno)
                  ->with('clasificacion',$clasificacion); 
    }
//------------------------------------------------------------------------
/**
     * Se trae todos los alumnos cursos que esten activos.
     *
     * @return \Illuminate\Http\Response
     */
    public function AlumnosCursos()
    {
        $alumnos    = Persona::where('tipo','alumno')
                             ->where('estado','activo')
                                ->join('incripciones','incripciones.idAlumno','=','alumnos.id')
                                ->join('profesiones','profesiones.tipo','=','incripciones.idProfesion')
                             ->where('profesiones.tipo','=','cursos')
                             ->orderBy('apellido','Asc')
                             ->get();

        $clasificacion  = ClasificacionAlumno::all(); 

        return view ('alumno.activos')
                  ->with('alumnos',$alumnos)
                  ->with('tipoalumno',$tipoalumno)
                  ->with('clasificacion',$clasificacion); 
    }
//------------------------------------------------------------------------
    /**
     * se trae todos los alumnos que estan inactivos.
     *
     * @return \Illuminate\Http\Response
     */
    public function AlumnosInactivos()
    {
        $alumnos = Persona::select('personas.*','telefonos.numero')
                           ->where('personas.tipo','alumno')
                           ->where('personas.estado','inactivo')
                           ->leftjoin('telefonos','telefonos.idPersona','=','personas.id')
                           ->orderBy('apellido','Asc')
                           ->get();

        $tipoAlumno = 'inactivo';

        return view ('alumno.inactivos')
                  ->with('tipoAlumno', $tipoAlumno)
                  ->with('alumnos',$alumnos); 
    }
//------------------------------------------------------------------------
     /**
     * Se trae todos los alumnos que estan activos ordenados por actualizacion o creacion.
     *
     * @return \Illuminate\Http\Response
     */
    public function AlumnosUltimos()
    {

        $alumnos = Persona::select('personas.*','telefonos.numero')
                          ->where('personas.tipo','alumno')
                          ->where('personas.estado','activo')
                              ->leftjoin('telefonos','telefonos.idPersona','=','personas.id')
                          ->orderBy('updated_at','Desc')
                          ->get();

         $clasificacion  = ClasificacionAlumno::all(); 

        return view ('alumno.activos')
                  ->with('alumnos',$alumnos)
                  ->with('tipoalumno','activos')
                  ->with('clasificacion',$clasificacion); 
    }
//------------------------------------------------------------------------
    /**
     * Guardado del alumno nuevo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreAlumno(Request $request)
    {
        
    //Control de inputs
        $request->validate([
            'nombre'         => 'required|string',
            'apellido'       => 'required|string',
            'dni'            => 'required|integer|max:100000000|min:1000000',
            'direccion'      => 'required|string|max:256| min:2',
            'localidad'      => 'required|string|max:256| min:4',
            'celular'        => 'required|numeric|max:9999999)|min:999999', 
        ]);
    //Controles de datos exitentes

     //Busco si la alumno ya esta exitente
            $alumno = Persona::where('dni',$request->dni)
                              ->get();
    
        //Si no la encuentra creo una
            if($alumno->isEmpty()){

                $alumno = new Persona();
            }
            else{
            //para que no me quede en forma de arreglo
               $alumno = Persona::find($alumno[0]->id);
            }

   //incersion de datos de alumno
   
    $alumno->dni             = $request->dni;
    $alumno->nombre          = $request->nombre;
    $alumno->apellido        = $request->apellido;
    $alumno->direccion       = $request->direccion;
    $alumno->localidad       = $request->localidad;
    $alumno->estado          = "activo";
    $alumno->tipo            = "alumno";
    $alumno->idClasificacion = $request->clasificacion;
    $alumno->save();

   //Busco el telefono
    $telefono = Telefono::where('numero'    ,$request->celular)
                        ->where('idPersona' ,$alumno->id)
                        ->get();

    //Si no la encuentro limpio y creo uno nuevo
    if($telefono->isEmpty()){
        $telefonoAnteriores = Telefono::where('idPersona',$alumno->id)
                                        ->get();

        if(!$telefonoAnteriores->isEmpty()){

            foreach($telefonoAnteriores as $unTelefono){

                $unTelefono->delete();
            }
        }                            
        $telefono = new Telefono();
        }
    else{
      //para que no me quede en forma de arreglo
        $telefono = Telefono::find($telefono[0]->id);
    }


   //incersion de datos de telefono
    $telefono->numero     = $request->celular;
    $telefono->whatsapp   = true;
    $telefono->estado     = 'activo';
    $telefono->idPersona  = $alumno->id;
    $telefono->save();


    return redirect('/Alumnos/Ultimos');

    }
//------------------------------------------------------------------------
    /**
     * Activar alumno que estaba inactivo
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ActivarAlumno($id)
    {
    //control que el alumno sea inactivo
        $alumno = Persona::where('id',$id)
                         ->where('estado','inactivo')
                         ->where('tipo'  ,'alumno')
                         ->get();
        
        if($alumno->isEmpty()){

            return redirect(url()->previous());
        }

    //cambio de estado como trae un arreglo el dato esta en la primera posicion
        $alumno[0]->estado ='activo';
        $alumno[0]->save();

        return redirect('/Alumnos/Ultimos');
    }
//------------------------------------------------------------------------
    /**
     * Actualizar los cambios relizados en el alumno.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UpdateAlumno(Request $request, $id)
    {  
        //control de inputs
        $request->validate([
            'nombre'         => 'required|string',
            'apellido'       => 'required|string',
            'dni'            => 'required|integer|max:100000000|min:1000000',
            'direccion'      => 'required|string|max:256| min:2',
            'localidad'      => 'required|string|max:256| min:4',
            'celular'         => 'required|numeric|max:9999999)|min:999999', 
        ]);

       //busco al alumno activo que se va editar
        $alumno = Persona::where('id',$id)
                         ->where('estado','activo')
                         ->where('tipo'  ,'alumno')
                         ->get();

       //control de que el alumno no este
        if($alumno->isEmpty()){

            return redirect(url()->previous());
        }
        else{
           //para que no me quede en forma de arreglo
            $alumno = Persona::find($alumno[0]->id);
        }
        
       //incersion de datos y guardado
        $alumno->dni             = $request->dni;
        $alumno->nombre          = $request->nombre;
        $alumno->apellido        = $request->apellido;
        $alumno->direccion       = $request->direccion;
        $alumno->localidad       = $request->localidad;
        $alumno->estado          = "activo";
        $alumno->tipo            = "alumno";
        $alumno->save();

       //Busco el telefono
        $telefono = Telefono::where('numero'    ,$request->celular)
                            ->where('idPersona' ,$alumno->id)
                            ->get();

      //Si no la encuentro limpio y creo uno nuevo
        if($telefono->isEmpty()){
            $telefonoAnteriores = Telefono::where('idPersona',$alumno->id)
                                           ->get();

            if(!$telefonoAnteriores->isEmpty()){

                foreach($telefonoAnteriores as $unTelefono){

                    $unTelefono->delete();
                }
            }                            
            $telefono = new Telefono();
        }
        else{
           //para que no me quede en forma de arreglo
            $telefono = Telefono::find($telefono[0]->id);
        }

        //incersion de datos de telefono
        $telefono->numero     = $request->celular;
        $telefono->whatsapp   = true;
        $telefono->estado     = 'activo';
        $telefono->idPersona  = $alumno->id;
        $telefono->save();


        return redirect('/Alumnos/Ultimos');
    }
//------------------------------------------------------------------------
    /**
     * Dar de baja logica o fisica un alumno.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bajaAlumno($id)
    {
        //busco al alumno 
        $alumno = Persona::where('id',$id)
                          ->get();
        //control de que el alumno no este
            if($alumno->isEmpty()){

                return redirect(url()->previous());
            }
        //control de eliminacion en caso que no este relacionado con entidades importantes

           //buscar si tiene relaciones importante
           $inscripciones       = inscripcion        ::where('idAlumno',$id)->get();
           $pagos               = Pago               ::where('idAlumno',$id)->get();
           $notificacionMorosos = Notificacion_Moroso::where('idPersona',$id)->get();
           $examenes            = Examen             ::where('idAlumno',$id)->get();
     
        //eliminar en csao que no tenga relaciones
            if($inscripciones->isEmpty()){
                if($pagos->isEmpty()){
                    if($notificacionMorosos->isEmpty()){

                        if($examenes->isEmpty()){
                           
                        //lo elimino de la tabla usuario
                            $user = User::join('personas','personas.idUsuario','=','users.id')
                                        ->where('personas.id',$id)
                                        ->get();

                            if(!$user->isEmpty()){
                                
                                $user[0]->delete();
                            }
                            
                        //elimino los telefonos asociados
                         $telefonos = Telefono::where('idPersona',$id)
                                              ->get();
                                              
                        if(!$telefonos->isEmpty()){
                            foreach($telefonos as $unTelefono){
                                $unTelefono->delete();
                             }
                        }
                         //elimino el alumno
                         $alumno->each->delete();
                         return redirect('/Alumnos/Activos');
                        } 
                    }
                    }
            }
            
        //caso en que el alumno tenia alguna tabla de relacion, en este caso se da una baja logica
        
            $alumno->estado = 'inactivo';
            $alumno->save();
        return redirect('/Alumnos/Activos');
    }

//-------------------------------------------------------------------------------------
     /**
      * Busqueda por dni (ajax) 
      *
      * @param  \Illuminate\Http\Request  $request 
      * @return \Illuminate\Http\Response
      */
      public function BuscarDni(Request  $request)
      {  
         if(isset($request->tipo)){
             if(isset($request->estado)){
                 $persona = Persona::where('dni',$request->dni)
                                   ->where('tipo',$request->tipo)
                                   ->where('estado',$request->estado)
                                   ->get();
             }
             else{
                 $persona = Persona::where('dni',$request->dni)
                                   ->where('tipo',$request->tipo)
                                   ->get();
             }}
         else{
             if(isset($request->estado)){
                 $persona = Persona::where('dni',$request->dni)
                                   ->where('estado',$request->estado)
                                   ->get();
             }
             else{
                 $persona = Persona::where('dni',$request->dni)
                                   ->get();
             }
         }
         //si esta vacia la defino en null
         if ($persona->isEmpty()){
             $persona = null;
         }
          return response(json_encode($persona),200)->header('Content-type','text/plain');
      }
}
