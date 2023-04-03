<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Profesion;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Listado de materias Segun la profesion
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Materias($id)
    {
        $materias = Materia::where('idProfesion',$id)
                           ->where('estado', 'activo')
                           ->orderBy('updated_at','Desc')
                           ->get();
     
        $profesion = Profesion::find($id);

        return view ('materia.materias')
                    ->with('materias',$materias)
                    ->with('idProfesion',$id)
                    ->With('profesion',$profesion);
    }
//------------------------------------------------------------------------
    /**
     * Listado de materias Segun la profesion ordenadas por creacion o actualizacion
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function MateriasInactivas($id)
    {
        $materias = Materia::where('idProfesion',$id)
                           ->where('estado', 'inactivo')
                           ->orderBy('updated_at','Desc')
                           ->get();

        return view ('materia.materias')
                  ->with('materias',$materias)
                  ->with('idProfesion',$id);
    }

//------------------------------------------------------------------------
    /**
     * Crea una nueva materia (id de profesion).
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CreateMateria($id)
    {   
    //Control de que exita la profesion activa 
        $profesion = Profesion::where('id',$id)
                              ->where('estado','activo')
                              ->where('materias',true)
                              ->get();

        if($profesion->isEmpty()){

            return redirect(url()->previous());
        }

        return view('materia.create')
                  ->with('profesion', $profesion);
    }
//------------------------------------------------------------------------
    /**
     * Guardado de la materia nueva.
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreMateria(Request $request,$id)
    {
    //Control de inputs
        $request->validate([
            'nombre'            => 'required|string',
            'temas'             => 'required|string',
            'duracion'          => 'required|string',
        ]);

    //Control de que exita la profesion activa
    $profesion = Profesion::where('id',$id)
                          ->where('estado','activo')
                          //->where('materias',true)
                          ->get();

        if($profesion->isEmpty()){

            return redirect(url()->previous());
        }

    //Guardado de la materia nueva
        $materia              = new Materia();
        $materia->nombre      = $request->nombre;
        $materia->temas       = $request->temas;
        $materia->duracion    = $request->duracion;
        $materia->estado      = 'activo';
        $materia->idProfesion = $id;
        $materia->save();

        return redirect('/Materias/'.$materia->idProfesion);
    }

//------------------------------------------------------------------------
    /**
     * Actualizacion de la materia.
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function UpdateMateria(Request $request, $id)
    {
    //Control de inputs
      $request->validate([
        'nombre'            => 'required|string',
        'temas'             => 'required|string',
        'duracion'          => 'required|string',
        ]);  

    //Control de que exita la materia activa
        $materia = Materia::where('id',$id)
                          ->where('estado','activo')
                          ->get();
    
        if($materia->isEmpty()){

            return redirect(url()->previous());
        }

    //actualizacion de la materia
        $materia[0]->nombre      = $request->nombre;
        $materia[0]->temas       = $request->temas;
        $materia[0]->duracion    = $request->duracion;
        $materia[0]->estado      = 'activo';
        $materia[0]->idProfesion = $id;
        $materia[0]->save();

        return redirect('/Materias/'.$materia[0]->idProfesion);
    }
//------------------------------------------------------------------------
    /**
     * Baja de una materia.
     * @param  int  $id
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function BajaMateria($id)
    {
    //control que este activa la materia y que la profesion no sea inactiva
        $materia = Materia::where('id',$id)
                          ->where('estado','activo')
                          ->get();

        $profesion = Profesion::find($materia[0]->idProfesion);

        if($materia->isEmpty() or ($profesion->estado == 'inactivo')){

            return redirect(url()->previous());
        }else{
            //para que no me quede en forma de arreglo
            $materia = Materia::find($id);
        }

    //controlo que no tenga relacion con material en caso de que si se hace baja logica
        // $resultado = Material::where('idMateria','$id')
        //                      ->get();
        
        // if($resultado->isEmpty()){

        //     $materia->delete();

        //     return redirect(url()->previous());
        // }
    
        $materia->estado ='inactivo';
        $materia->save();

        return redirect('/Materias/'.$materia->idProfesion);    
    }

    //------------------------------------------------------------------------
    /**
     * Activar una materia.
     * @param  int  $id
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function ActivarMateria($id)
    {
    //control que este activa la materia y que la profesion no sea inactiva
        $materia = Materia::where('id',$id)
                          ->where('estado','inactivo')
                          ->get();
        
        $profesion = Profesion::find($materia[0]->idProfesion);
        
        if($materia->isEmpty() or ($profesion->estado == 'inactivo')){

            return redirect(url()->previous());
        }else{
            //para que no me quede en forma de arreglo
            $materia = Materia::find($id);
        }

    //controlo que no tenga relacion con material en caso de que si se hace baja logica
        // $resultado = Material::where('idMateria','$id')
        //                      ->get();
        
        // if($resultado->isEmpty()){

        //     $materia->delete();

        //     return redirect(url()->previous());
        // }
    
        $materia->estado ='activo';
        $materia->save();

        return redirect('/Materias/'.$materia->idProfesion);    
    }
}
