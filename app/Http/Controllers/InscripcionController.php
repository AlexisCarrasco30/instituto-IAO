<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    /**
     * Se traen todas las incripciones
     *
     * @return \Illuminate\Http\Response
     */
    public function TodasIncripciones()
    {
        $incripciones = Incripcion::where('estado','activo')
                                  ->orderBy('fecha','Desc')
                                  ->get();
    
        return view('inscripcion.inscripciones')
                  ->with('inscripciones', $inscripciones);
    }

    /**
     * Realizar una inscripcion
     *
     * @return \Illuminate\Http\Response
     */
    public function createInscripcion()
    { 
    //Traigo todas las Profesiones activas para que usuario lo pueda selecionar
        $profesiones = profesion::where('estado','activo')
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
    public function storeInscripcion(Request $request)
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

    //incersion de datos y guardado de inscripcion
        $inscripcion                       = new Inscripcion();
        $inscripcion->matriculo            = $request->matricula;
        $inscripcion->modalidad            = $request->modalidad;
        $inscripcion->descripcionAdicional = $request->descripcionAdicional;
        $inscripcion->estado               = 'activo';
    



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscripcion $inscripcion)
    {
        //
    }
}
