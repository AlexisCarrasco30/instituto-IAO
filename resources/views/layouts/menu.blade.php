
 @extends('layouts.plantillaBase') 

     <!--Data Table -->
     <link href="https://cdn.datatables.net/v/dt/dt-1.13.3/r-2.4.0/datatables.min.css"/>
     <link href=" https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
  <!--data table  -->
     <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" />
     <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css"/> 
  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('estilo.css') }}" />

 <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #016C98;">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">Sistema IAO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/index"><i class="fa-solid fa-house"></i> Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i> Alumnos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/Alumnos/Activos">Alumnos Activos</a></li>
            <li><a class="dropdown-item" href="">Corporativos</a></li>
            <li><a class="dropdown-item" href="#">Cursos</a></li>
            <li><a class="dropdown-item" href="/Alumnos/Inactivos">Alumnos Inactivo</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-money-bill"></i> Pagos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
         
            <li><a class="dropdown-item" href="#">Activos</a></li>
            <li><a class="dropdown-item" href="#">Morosos</a></li>
          
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-folder"></i> Historial Academico 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
         
            <li><a class="dropdown-item" href="#">Examenes</a></li>
            <li><a class="dropdown-item" href="#">Plan de Estudio</a></li>
          
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-landmark"></i> Oferta Academica 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/Cursos/Activos">Cursos</a></li>
            <li><a class="dropdown-item" href="/Secundaria/Activas">Secundarias</a></li>
            <li><a class="dropdown-item" href="/Universidad/Activas">Universidades</a></li>
     
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-circle-exclamation"></i> Alertas
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
         
            <li><a class="dropdown-item" href="#">Listado de Configuración</a></li>
            <li><a class="dropdown-item" href="#">Configuración</a></li>
          
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/mensajes"><i class="fa-solid fa-message"></i> Mensaje</a>
        </li>
      @if(auth()->user())
        <li class="nav-item dropdown ">      
          <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Usuario"> <i class="fa-solid fa-user"></i> Usuario: {{auth()->user()->tipo}}</a>
          <ul class="dropdown-menu">
            <li>
              <a href='#' class="dropdown-item " onclick ="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-to-bracket"></i> Cerrar</a>
            </li>
          </ul>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      @endif
      </ul>
    </div>
  </div>
</nav>

 <!-- data table script -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>

