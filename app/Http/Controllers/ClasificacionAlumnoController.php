<?php

namespace App\Http\Controllers;

use App\Models\ClasificacionAlumno;
use Illuminate\Http\Request;

class ClasificacionAlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreClasificacion(Request $request)
    { 
        $clasificacion = new ClasificacionAlumno();
        $clasificacion->descripcion = $request->nombreCategoria;
        $clasificacion->porcentajeDesc = 0;
        if($request->corporativo =='si'){
            $clasificacion->corporativo = true;
        }
        else{
            $clasificacion->corporativo = false; 
        }
        
        $clasificacion->save();
        return redirect('/Alumnos/Activos');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClasificacionAlumno  $clasificacionAlumno
     * @return \Illuminate\Http\Response
     */
    public function show(ClasificacionAlumno $clasificacionAlumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClasificacionAlumno  $clasificacionAlumno
     * @return \Illuminate\Http\Response
     */
    public function edit(ClasificacionAlumno $clasificacionAlumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClasificacionAlumno  $clasificacionAlumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClasificacionAlumno $clasificacionAlumno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClasificacionAlumno  $clasificacionAlumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClasificacionAlumno $clasificacionAlumno)
    {
        //
    }
}
