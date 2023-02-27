<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\Telefono;

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

        $tutores = Persona::join('tutores','tutores.idTutor','=','personas.id')
                            ->select('persona.*','tutores.idAlumno as alumno')
                            ->get();

        $alumnos = Persona::where('tipo','alumno')
                          ->where('estado','activo')
                          ->leftJoin('tutores', 'tutores.idAlumno','=','personas.id')
                          ->orderBy('apellido','Asc')
                          ->get();

        return view ('alumno.activos')
                  ->with('alumnos',$alumnos); 
    }
//------------------------------------------------------------------------
    /**
     * se trae todos los alumnos que estan inactivos.
     *
     * @return \Illuminate\Http\Response
     */
    public function AlumnosInactivos()
    {
        $alumnos = Persona::where('tipo','alumno')
                          ->where('estado','activo')
                          ->orderBy('apellido','Asc')
                          ->get();

        return view ('alumno.inactivos')
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
        $alumnos = Persona::where('tipo','alumno')
                          ->where('estado','activo')
                          ->orderBy('updated_at','Desc')
                          ->get();

        return view ('alumno.activos')
                  ->with('alumnos',$alumnos); 
    }
//------------------------------------------------------------------------
    /**
     * Crea nuevo alumno.
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateAlumno()
    {
        return view('alumno.create');
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
            'fechaNacimiento'=> 'date',
            'calle'          => 'required|string|max:256| min:4',
            'numeroCalle'    => 'required|integer|min:1|max:9999',
            'codigoArea'     => 'required|numeric|max:9999|min:99',
            'numero'         => 'required|numeric|max:9999999|min:999999', 
            'whatsapp'       => 'required|boolean', 
        ]);
    //Controles de datos exitentes

     //Busco si la alumno ya esta exitente
            $alumno = alumno::where('dni',$request->dni)
                              ->get();
    
        //Si no la encuentra creo una
            if($alumno->isEmpty()){

                $alumno = new Persona();
            }
            else{
            //para que no me quede en forma de arreglo
               $alumno = Persona::find($alumno[0]->id);
            //cambio de estado del numero que esta asignado para whatsapp
               $telefonoWhatsapp = telefono::where('persona_id',$alumno->id)
                                           ->where('whatsapp','true')
                                           ->get();

               $telefonoWhatsapp->whatsapp = false;
               $telefonoWhatsapp->save();
            }
    //Busco el telefono
            $telefono::where('codigoArea',$request->codigoArea)
                     ->where('numero'    ,$request->numero)
                     ->get();
        //Si no la encuentro creo un
            if($telefono->isEmpty()){

                $telefono = new Telefono();
            }
            else{
            //para que no me quede en forma de arreglo
                    $telefono = Telefono::find($telefono[0]->id);
            }

   //incersion de datos de alumno
    $alumno->dni             = $request->dni;
    $alumno->nombre          = $request->nombre;
    $alumno->apellido        = $request->apellido;
    $alumno->numeroCalle     = $request->numeroCalle;
    $alumno->calle           = $request->calle;
    $alumno->fechaNacimiento = $request->fechaNacimiento;
    $alumno->estado          = "activo";
    $alumno->tipo            = "alumno";
    $alumno->save();

   //incersion de datos de telefono
    $telefono->codigoArea = $request->codigoArea;
    $telefono->numero     = $request->numero;
    $telefono->whatsapp   = $request->whatsapp;
    $telefono->persona_id = $alumno->id;
    $telefono->save();

    return redirect('/Alumnos/Ultimos');

    }
//------------------------------------------------------------------------
    /**
     * Mostrar los datos para editarlos-
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function EditAlumno($id)
    {
    //control de que el alumno no este y sea activo
    $alumno = Persona::where('id',$id)
                     ->where('estado','activo')
                     ->where('tipo'  ,'alumno')
                     ->get();

        if($alumno->isEmpty()){

            return redirect(url()->previous());
        }

        return view('alumno.edit')
                  ->with('alumno', $alumno);
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

    //cambio de estado
        $alumno->estado='activo';
        $alumno->save();

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
        $request->validate([
            'nombre'         => 'required|string',
            'apellido'       => 'required|string',
            'dni'            => 'required|integer|max:100000000|min:1000000',
            'fechaNacimiento'=> 'date',
            'calle'          => 'required|string|max:256| min:4',
            'numeroCalle'    => 'required|integer|min:1|max:9999',
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
        $alumno->numeroCalle     = $request->numeroCalle;
        $alumno->calle           = $request->calle;
        $alumno->fechaNacimiento = $request->fechaNacimiento;
        $alumno->estado          = "activo";
        $alumno->tipo            = "alumno";
        $alumno->save();

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
        $alumno = Persona::find($id);

        //control de que el alumno no este
            if($alumno->isEmpty()){

                return redirect(url()->previous());
            }
        //control de eliminacion en caso que no este relacionado con entidades importantes

           //buscar si tiene relaciones imortante
           $incripciones        = Inscripcion       ::where('idAlumno',$id)->get();
           $pagos               = Pago              ::where('idAlumno',$id)->get();
           $notificacionMorosos = NotificacionMoroso::where('idPersona',$id)->get();
           $examenes            = Examen            ::where('idAlumno',$id)->get();

        //eliminar en csao que no tenga relaciones
            if($incripciones->isEmpty()){
                if($pagos->isEmpty()){
                    if($notificacionMorosos->isEmpty()){

                        if($examenes->isEmpty()){
                        //lo elimino de la tabla usuario
                            $user = User::join('personas','personas.idUsuario','=','users.id')
                                        ->where('persoanas.id',$id)
                                        ->get();

                            if(!$user->isEmpty()){
                                $user[0]->delete();
                            }
                            
                        //elimino los telefonos asociados
                         $telefonos = Telefono::where('persona_id',$id)
                                              ->get();
                                              
                        if(!$telefonos->isEmpty()){
                            
                            foreach($telefonos as $unTelefono){
                                $unTelefono->delete();
                             }
                        }
                         //elimino de la tabla tutor
                         $tutor   = Tutor::Where('idAlumno',$id)
                                         ->get();
                        
                         if(!$tutor->isEmpty()){
                            $persona = personas::Where('id',$tutor[0]->idTutor)
                                               ->get();
                            $tutor->delete();
                            // si el tutor no esta a cargo de otra persona y es turor se elimina
                            $tutor  = tutor::Where('idTutor', $persona[0]->id)
                                           ->get();
                            
                            if($tutor->isEmpty() and $persona->tipo = 'tutor'){
                                
                                $persona->delete();
                            }
                            
                         //elimino el alumno
                         $alumno->delete;
                         } 
                        }
                    }
                }
            }
        //caso en que el alumno tenia alguna tabla de relacion, en este caso se da una baja logica
        if(!$alumno->isEmpty()){
            $alumno->estado = 'inactivo';
            $alumno->save();
        }
        return redirect('/Alumnos/Activos');
    }

//-------------------------------------------------------------------------------------
     /**
      * Busqueda por dni (ajax) 
      *
      * @param  \Illuminate\Http\Request  $request 
      * @return \Illuminate\Http\Response
      */
      public function buscarDni(Request  $request)
      {  
         if(isset($request->tipo)){
             if(isset($request->estado)){
                 $persona::where('dni',$request->dni)
                         ->where('tipo',$request->tipo)
                         ->where('estado',$request->estado)
                         ->get();
             }
             else{
                 $persona::where('dni',$request->dni)
                         ->where('tipo',$request->tipo)
                         ->get();
             }}
         else{
             if(isset($request->estado)){
                 $persona::where('dni',$request->dni)
                         ->where('estado',$request->estado)
                         ->get();
             }
             else{
                 $persona::where('dni',$request->dni)
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
