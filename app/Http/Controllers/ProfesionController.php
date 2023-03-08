<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use Illuminate\Http\Request;

class ProfesionController extends Controller
{
    /**Se trean todas las carreras activas
    * .
    *
    * @return \Illuminate\Http\Response
    */
   public function CarrerasActivas()
   {
       $carreras = Profesion::where('estado','activo')
                               ->where('tipo','carrera')
                               ->orderBy('titulo','Asc')
                               ->get();

       return view ('profesion.carrerasActivas')
                 ->with('carreras',$carreras);
   }
//------------------------------------------------------------------------
   /**Se trean todas las profesiones antiguas
    * .
    *
    * @return \Illuminate\Http\Response
    */
   public function profesionesInactivas()
   {
       $profesiones = Profesion::where('estado','inactivo')
                               ->orderBy('titulo','Asc')
                               ->get();

       return view ('profesion.profesion')
                 ->with('profesiones',$profesiones);
   }
//------------------------------------------------------------------------ 
   /**Se trean todas las profesiones activas ordenadas por ultima actualizada
    * .
    *
    * @return \Illuminate\Http\Response
    */
   public function ProfesionesUltimas()
   {
       $profesiones = Profesion::where('estado','activo')
                               ->orderBy('updated_at','Desc')
                               ->get();

       return view ('profesion.profesion')
                 ->with('profesiones',$profesiones);
   }
//------------------------------------------------------------------------
   /**Se trean todas las profesiones historicas
    * .
    *
    * @return \Illuminate\Http\Response
    */
   public function ProfesionesHistoricas()
   {
       $profesiones = Profesion::orderBy('titulo','Asc')
                               ->get();

       return view ('profesion.profesion')
                 ->with('profesiones',$profesiones);
   }
//------------------------------------------------------------------------  

   /**
    * Creacion de nueva profesion.
    *
    * @return \Illuminate\Http\Response
    */
   public function CreateProfesion()
   {
       return view('Profesion.create');
   }
//------------------------------------------------------------------------ 
   /**
    * Guardador de la nuena profesion.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function StoreProfesion(Request $request)
   {
   //Control de inputs
       $request->validate([
           'titulo'            => 'required|string',
           'precioMatricula'   => 'required|string',
           'planEstudio'       => 'required|string',
           'precioTotal'       => 'required|integer|max:100000000|min:1000000',
           'duracion'          => 'required|integer',
           'tipo'              => 'required|string',
       ]);
   //Nueva profesion e incersion de datos
       $profesion                  = new Profesion();
       $profesion->titulo          = $request->titulo;
       $profesion->precioMatricula = $request->precioMatricula;
       $profesion->planEstudio     = $request->planEstudio;
       $profesion->precioTotal     = $request->precioTotal;
       $profesion->duracion        = $request->duracion;
       $profesion->tipo            = $request->tipo;
       $profesion->estado          = 'Activo';
       $profesion->materias        = $request->materias;
       $profesion->save();
       
       return redirect('/Profesiones/Ultimas');
   }
//------------------------------------------------------------------------ 
   /**
    * Editar una profesion.
    * @param  int  $id
    * @param  \App\Models\Profesion  $profesion
    * @return \Illuminate\Http\Response
    */
   public function EditProfesion(Profesion $profesion, $id)
   {
   //control de que sea una profesion activa
       $profesion = Profesion::where('id',$id)
                             ->where('estado','activa')
                             ->get();

       if($profesion->isEmpty()){

           return redirect(url()->previous());

       }

       return view('profesion.edit')
                 ->with('profesion', $Profesion);
   }
//------------------------------------------------------------------------ 
   /**
    * Actualizacion de la profesion editada.
    * @param  int  $id
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Profesion  $profesion
    * @return \Illuminate\Http\Response
    */
   public function UpdateProfesion(Request $request, $id)
   {
   //Control de los inputs
       $request->validate([
           'titulo'            => 'required|string',
           'precioMatricula'   => 'required|string',
           'planEstudio'       => 'required|string',
           'precioTotal'       => 'required|integer|max:100000000|min:1000000',
           'duracion'          => 'required|integer',
           'tipo'              => 'required|string',
       ]);
   //control de que sea una profesion activa
       $profesion = Profesion::where('id',$id)
                             ->where('estado','activa')
                             ->get();

       if($profesion->isEmpty()){

           return redirect(url()->previous());

       }else{
           //para que no me quede en forma de arreglo
           $profesion = Profesion::find($id);
       }
   //guardado de los cambios
       $profesion->titulo          = $request->titulo;
       $profesion->precioMatricula = $request->precioMatricula;
       $profesion->planEstudio     = $request->planEstudio;
       $profesion->precioTotal     = $request->precioTotal;
       $profesion->duracion        = $request->duracion;
       $profesion->tipo            = $request->tipo;
       $profesion->materias        = $request->materias;
       $profesion->save();

       return redirect('/Profesiones/Ultimas');                    
   }

   /**
    * Baja de profesion.
    * @param  int  $id
    * @param  \App\Models\Profesion  $profesion
    * @return \Illuminate\Http\Response
    */
   public function BajaProfesion(Profesion $profesion, $id)
   {
   //Control de que exista y se una profesion activa
       $profesion = Profesion::where('id',$id)
                             ->where('estado','activa')
                             ->get();

       if($profesion->isEmpty()){

           return redirect(url()->previous());
       }else{
           //para que no me quede en forma de arreglo
           $profesion = Profesion::find($id);
       }

   //la baja se realiza en forma logica si esta relacionada a alguna tabla en casoi contrario se realiza en forma fisica
       $materia    = Materia    ::where('idProfesion',$id)->get();
       $evaluacion = Evaluacion ::where('idProfesion',$id)->get();
       $examen     = Examen     ::where('idProfesion',$id)->get();
       $incripcion = Inscripcion::where('idProfesion',$id)->get();
       $material   = Material   ::where('idProfesion',$id)->get();
       $mes        = Mes        ::where('idProfesion',$id)->get();
       $moroso     = Moroso     ::where('idProfesion',$id)->get();
       $pago       = Pago       ::where('idProfesion',$id)->get();

       if($materia->isEmpty() && $evaluacion->isEmpty() && $examen->isEmpty()){

           if($incripcion->isEmpty() && $material->isEmpty() && $mes->isEmpty()){

               if($moroso->isEmpty() && $pago->isEmpty()){

                   $profesion->delete();
                   return redirect(url()->previous());
               }
           }
       }
       $profesion->estado = "inactivo";
       $profesion->save();

       return redirect(url()->previous());
   }
}
