@extends('layouts.app')

@section('content')

<div>
    <table id="example" class="table table-striped" style="width:100%">
    <!-- Cabecera        -->
        <thead>
            <tr>    
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Dni</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Alumno as $unAlumno)
                <tr>
                    <td>{{$unAlumno->nombre}}</td>
                    <td>{{$unAlumno->apellido}}</td>
                    <td>{{$unAlumno->dni}}</td>
                <!-- datos disponible de alumno 
                        $unAlumno->nombre
                        $unAlumno->apellido
                        $unAlumno->numeroCalle
                        $unAlumno->calle
                        $unAlumno->fechaNacimiento
                        $unAlumno->tipo
                        $unAlumno->estado -->

                <!-- datos disponible de telefono (trae un arrego de telefono usar @foreach|@endforeach)
                        $unAlumno->telefonos[x]->codigoArea
                        $unAlumno->telefonos[x]->numero
                        $unAlumno->telefonos[x]->whatsapp
                        $unAlumno->telefonos[x]->estado -->

                <!-- datos disponible de usuario 
                        $unAlumno->usuario[0]->name
                        $unAlumno->usuario[0]->email
                   -->
                <!-- datos disponibles de tutor (utilizar @if | @else |@endif)
                        $unAlumno->idTutor
                        $unAlumno->dniTutor
                        $unAlumno->nombreTutor
                        $unAlumno->apellidoTutor
                        para obtener numero de telefono se necesita hacer (recordar que es un arreglo) 
                            $telefonoTutor::where('idPersona',$unAlumno->idTutor)
                -->

                    <td>
                        <!-- posibles rutas de acciones de alumno      

                        '/Alumnos/Inactivos',   // trae los alumnos inactivos
                        '/Alumnos/Ultimos',     // los trae en forma ordenada sefun su edicion (trae los mas reciente)
                        '/Create/Alumno',       // creacion de los turnos
                        '/Edit/Alumno/{id}',    // edicion de los turnos 
                        '/Baja/Alumno/{id}',    // baja fisica y logica de alumno (automatico)
                        '/Activar/Alumno/{id}'  // activacion de alumno
                    
                    -->

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection