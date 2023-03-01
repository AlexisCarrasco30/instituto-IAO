
@extends('layouts.menu') 
<style>
.titulo{
    font-family: 'Gluten', cursive !important;
    text-align: center; 
    padding-top: 20px!important;
    color:#016C98 !important;
}
.imagen{
    height:700px!important; 
     width:900px!important;
     text-align: center !important;
     padding-left: 10px !important;

}
</style>



@section('contenido')
<div class="content text-center">
    <h2 class="titulo">Bienvenidos al Sistema de Instituto Argentino de Oficio</h2>

    <img src="./imagenes/portada.jpg" class="imagen" alt="imagen de fondo sistema">
    
</div>


@endsection
