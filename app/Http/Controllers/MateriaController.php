<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Listado de materias Segun la profecion
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Materias($id)
    {
        $materias = Materia::where('idProfecion',$id)
                           ->get();

        return view ('materia.materias')
                  ->with('materias',$materias);
    }
//------------------------------------------------------------------------
    /**
     * Listado de materias Segun la profecion ordenadas por creacion o actualizacion
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function MateriasUltimas($id)
    {
        $materias = Materia::where('idProfecion',$id)
                           ->orderBy('updated_at','Desc')
                           ->get();

        return view ('materia.materias')
                  ->with('materias',$materias);
    }

//------------------------------------------------------------------------
    /**
     * Crea una nueva materia (id de profecion).
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CreateMateria($id)
    {   
    //Control de que exita la profecion activa 
        $profecion = Profecion::where('id',$id)
                              ->where('estado','activo')
                              ->where('materias',true)
                              ->get();

        if($profecion->isEmpty()){

            return redirect(url()->previous());
        }

        return view('materia.create')
                  ->with('profecion', $profecion);
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
            'duracion'          => 'required|integer',
        ]);

    //Control de que exita la profecion activa
    $profecion = Profecion::where('id',$id)
                          ->where('estado','activo')
                          ->where('materias',true)
                          ->get();

        if($profecion->isEmpty()){

            return redirect(url()->previous());
        }

    //Guardado de la materia nueva
        $materia              = new Materia();
        $materia->nombre      = $request->nombre;
        $materia->temas       = $request->temas;
        $materia->duracion    = $request->duracion;
        $materia->estado      = 'activo';
        $materia->idProfecion = $id;
        $materia->save();

        return redirect('/Materias/Ultimas');
    }

//------------------------------------------------------------------------
    /**
     * Edicion de una materia.
     * @param  int  $id
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function EditMateria(Materia $materia,$id)
    {
    //Control de que exita la materia activa
        $materia = Materia::where('id',$id)
                          ->where('estado','activo')
                          ->get();

        if($materia->isEmpty()){

            return redirect(url()->previous());
        }  
        
        return view('materia.edit')
                  ->with('materia', $materia);
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
        'duracion'          => 'required|integer',
        ]);  

    //Control de que exita la materia activa
        $materia = Materia::where('id',$id)
                          ->where('estado','activo')
                          ->get();

        if($materia->isEmpty()){

            return redirect(url()->previous());
        }else{
            //para que no me quede en forma de arreglo
            $materia = Profecion::find($id);
        }

    //actualizacion de la materia
        $materia->nombre      = $request->nombre;
        $materia->temas       = $request->temas;
        $materia->duracion    = $request->duracion;
        $materia->estado      = 'activo';
        $materia->idProfecion = $id;
        $materia->save();

        return redirect('/Materias/Ultimas');
    }
//------------------------------------------------------------------------
    /**
     * Baja de una materia.
     * @param  int  $id
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function BajaMateria(Materia $materia, $id)
    {
    //control que este activa la materia y que la profecion no sea inactiva
        $materia = Materia::where('id',$id)
                          ->where('estado','activo')
                          ->get();
        
        if($materia->isEmpty() or ($materia->profecion->estado == 'inactivo')){

            return redirect(url()->previous());
        }else{
            //para que no me quede en forma de arreglo
            $materia = Profecion::find($id);
        }

    //controlo que no tenga relacion con material en caso de que si se hace baja logica
        $resultado = Material::where('idMateria','$id')
                             ->get();
        
        if($resultado->isEmpty()){

            $materia->delete();

            return redirect(url()->previous());
        }
    
        $materia->estado ='inactivo';
        $materia->save();

        return redirect(url()->previous());    
    }
}
