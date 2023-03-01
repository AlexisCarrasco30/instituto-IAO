@extends('layouts.app')

@section('content')

   <span > Realizar pago </span> 
    
    <form action="/Store/Pago" method="POST" id="formulario">
         @csrf
        <!--input por cual se hace la busqueda dni y habilita nombre y apellido y se trae sus incripciones -->
        <!-- utilizacion de ajax. ruta = '/Buscar/Dni' -->
        <div>
            <label for="Dni">DNI</label>
            <input id="Dni" name="Dni" type="text">
        </div>
        <!-- solo se muestra cuando se encuentra el cliente -->
        <div hidden>
            <div>
                <label for="nombre">Apellido y nombre</label>
                <input id="ApeNom" name="ApeNom" type="text" readonly>
            </div>
        </div>
        <!-- se muestra las profeciones a las cuales esta incripto-->
        <!-- utilizacion de ajax. y inner html ruta = '/Buscar/Profesion/Incriptas/DNI' -->
        <select  id = 'profeciones' name = "profesiones">
             <option value=" " class="seleccion"></option>
        </select> 

        <div class="container-fluid d-flex justify-content-center m-2">
            <a href="{{url()->previous()}}" class="btn btn-secondary m-2" name="cancelar" id="cancelar" tabindex="6">Cancelar</a>
            <button type="submit" class="btn btn-primary m-2" tabindex="7">Guardar</button>
        </div>
    </form>
        </div>
    </div>
</div>

<script src="{{asset('validarCliente.js')}}" defer></script>
@endsection