@extends('layouts.app')

@section('content')

   <span > Realizar pago </span> 
    
    <form action="/Store/Pago" method="POST" id="formulario">
         @csrf
        <!--input por cual se hace la busqueda dni y habilita nombre y apellido y se trae sus incripciones -->
        <!-- utilizacion de ajax. ruta = '/Buscar/Dni' -->
        <div>
            <label for = "Dni">DNI</label>
            <input id = "Dni" name = "Dni" type = "text">
        </div>
        <!-- solo se muestra cuando se encuentra el cliente -->
        <div hidden>
            <div>
                <label for = "nombre">Apellido y nombre</label>
                <input id = "ApeNom" name = "ApeNom" type="text" readonly>
            </div>
        </div>
        <!-- se muestra las profeciones a las cuales esta incripto-->
        <!-- utilizacion de ajax. y inner html ruta = '/Buscar/Profesion/Incriptas/DNI' -->
        <div>
            <select  id = 'profeciones' name = "profesiones">
                 <option value=" " class="seleccion"></option>
            </select> 
        </div>
        <!-- tabla donde se muestran los meses disponibles para pagar se habilitar una vez que encuentra la profesion -->
        <!-- ajax. y inner html  ruta = 'Mes/No/Pagados'-->
        <div>
            <thead>
                <tr>    
                    <th scope="col">chk          </th>
                    <th scope="col">mes          </th>
                    <th scope="col">monto        </th>
                    <th scope="col">monto a pagar</th>
                </tr>
            </thead>
            <tbody>
                <!-- los tr y td se crean con java script -->
            </tbody>
        </diV>
        <!-- se habilita al apretar chk -->
        <!-- se calcula java script inner hatml-->
        <div>
            <input id = "Total" name = "Total" type = "text" readonly>
        </div>
        <!-- botones -->
        <div>
            <a href="{{url()->previous()}}" class="btn btn-secondary m-2" name="cancelar" id="cancelar" tabindex="6">Cancelar</a>
            <!-- se habilita cuando hay dato en total pero mayor a cero -->
            <div hidden>
                <button type="submit" class="btn btn-primary m-2" tabindex="7">Guardar</button>
            </div>
        </div>
    </form>
        </div>
    </div>
</div>

<script src="{{asset('validarCliente.js')}}" defer></script>
@endsection