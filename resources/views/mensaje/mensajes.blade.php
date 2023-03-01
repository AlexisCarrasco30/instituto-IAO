@extends('layouts.menu')
<style>
.formulario{

    background-color:#016C98 !important;
    color:white;
    padding: 20px;
    border-radius: 10px;
}


</style>



@section('contenido')
<div class="container">
    <div class="text-center p-4">
        <h1>Enviar Mensaje</h1>
    </div>
<div class="container w-75 text-center">
            <form class="border p-4 formulario">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Para</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="xxx@gmail.com" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Asunto</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="asunto del mensaje">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class= "form-label">Mensaje</label>
            <textarea type="text" class= "form-control" id="exampleInputPassword1"></textarea>
        </div>
                  <button type= "button" class= "btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
         <button type="submit" class= "btn btn-primary">Enviar</button>
        </form>
</div>

@endsection 
