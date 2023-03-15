<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use Illuminate\Http\Request;
use App\Models\Universidad;
use App\Models\Materia;
use App\Models\Evaluacion;
use App\Models\Examen;
use App\Models\Inscripcion;
use App\Models\Material;
use App\Models\Mes;
use App\Models\Moroso;
use App\Models\Pago;
 
class ProfesionController extends Controller
{
    /**Se trean todas las universidades activas
    * .
    *
    * @return \Illuminate\Http\Response
    */
   public function UniversidadActivas()
   {
       $universidad = Profesion::where('estado','activo')
                               ->where('tipo','universidad')
                               ->orderBy('titulo','Asc')
                               ->get();

       $clasificacion = Universidad::all();

       return view ('profesion.universidadesActivas')
                 ->with('universidad',$universidad)
                 ->with('clasificacion',$clasificacion);
   }
//------------------------------------------------------------------------
    /**Se trean todas las carreras activas
    * .
    *
    * @return \Illuminate\Http\Response
    */
    public function SecundariaActivas()
    {
        $secundaria = Profesion::where('estado','activo')
                                ->where('tipo','secundaria')
                                ->orderBy('titulo','Asc')
                                ->get();
 
        return view ('profesion.secundariasActivas')
                  ->with('secundaria',$secundaria);
    }
//------------------------------------------------------------------------
    /**Se trean todas las carreras activas
    * .
    *
    * @return \Illuminate\Http\Response
    */
    public function CursosActivos()
    {
        $cursos = Profesion::where('estado','activo')
                              ->where('tipo','curso')
                              ->orderBy('titulo','Asc')
                              ->get();
 
        return view ('profesion.cursosActivos')
                  ->with('cursos',$cursos);
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
   /**
    * Se trean todas las profesiones activas ordenadas por ultima actualizada.
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function ProfesionesUltimas($id)
   {
    if($id =='universidad'){

        $universidad = Profesion::where('estado','activo')
                                ->where('tipo','universidad')
                                ->orderBy('updated_at','Desc')
                                ->get();

       $clasificacion = Universidad::all();

       return view ('profesion.universidadesActivas')
                 ->with('universidad',$universidad)
                 ->with('clasificion',$clasificacion);
    }

    if($id == 'curso'){

        $cursos = Profesion::where('estado','activo')
                            ->where('tipo','curso')
                            ->orderBy('updated_at','Desc')
                            ->get();
 
        return view ('profesion.cursosActivos')
                  ->with('cursos',$cursos);
    }
    if($id == 'secundaria'){
        $secundaria = Profesion::where('estado','activo')
                                ->where('tipo','secundaria')
                                ->orderBy('updated_at','Desc')
                                ->get();
 
        return view ('profesion.secundariasActivas')
                  ->with('secundaria',$secundaria);

    }
       

    return redirect(url()->previous());
   }

//------------------------------------------------------------------------ 
   /**
    * Guardador de la nueva profesion.
    * @param  int  $id
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function StoreProfesion(Request $request,$id)
   {
   //Control de inputs
       $request->validate([
           'titulo'            => 'required|string',
           'precioMatricula'   => 'required|string',
           'planEstudio'       => 'required|string',
           'duracion'          => 'required|string',
       ]);

   //Nueva profesion e incersion de datos
       $profesion                  = new Profesion();
       $profesion->tipo            = $id;
       $profesion->titulo          = $request->titulo;
       $profesion->precioMatricula = $request->precioMatricula;
       $profesion->planEstudio     = $request->planEstudio;
       $profesion->duracion        = $request->duracion;
       $profesion->estado          = 'activo';
       $profesion->save();
       
       return redirect('/Profesiones/Ultimas/$id');
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
            'duracion'          => 'required|string',
       ]);
   //control de que sea una profesion activa
       $profesion = Profesion::where('id',$id)
                             ->where('estado','activo')
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
        $profesion->duracion        = $request->duracion;
        $profesion->save();
        $id = $profesion->tipo;
        
       return redirect('/Profesiones/Ultimas/$id');                    
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
                             ->where('estado','activo')
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
