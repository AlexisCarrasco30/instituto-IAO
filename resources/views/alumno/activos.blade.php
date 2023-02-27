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
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Alumno as $unAlumno)
                <tr>
                    <td>{{$unaPersona->nombre}}</td>
                    <td>{{$unaPersona->apellido}}</td>
                    <td>{{$unaPersona->dni}}</td>
                    <td>{{$unaPersona->direccion}} {{$unaPersona->numeroCalle}}</td>
                    <td>{{$unaPersona->telefonos->codigoArea}}{{$unaPersona->telefonos->numero}}</td>
                    <td class="text-start"><a href="{{ route('verMascotas', $unaPersona->id)}}" name="mascota" class="btn btn" title="Ver Mascotas"><i class="fa-solid fa-dog"></i></a> </td>
                    <td>
                                  
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection