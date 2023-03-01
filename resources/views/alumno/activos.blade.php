@extends('layouts.menu')


<style>
table th{
    background-color: #016C98 !important;
    color:#ffffff;
}


.cuerpo_modal{
    background-color:#016C98 !important;
}
.cabecera_modal{
    text-align: justify!important;
    color:white;
    background-color:#016C98 !important;
}
.footer_modal{
    background-color:#016C98 !important;
}
.eliminar{
    color:red !important;
}
.eliminar:hover{
    color:black!important;
}
.whatsApp{
    color:green !important; 
}
.whatsApp:hover{
    color:black!important;
}
.editar{
    color:blue!important; 
}
.editar:hover{
    color:black !important;
}

</style>
@section('contenido')
<div class="container">
    <div class="text-center p-4">
        <h1>Alumnos Activos</h1>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" title="Agregar Alumno" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-user-plus"></i> Agregar Alumno 
        </button>
        </div>
        <div class="col-12 p-3"></div>
    </div>
       <div class="row">
          <div class="col-12">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>NOMBRE</th>
                            <th>APELLIDO</th>
                            <th>DIRECCIÓN</th>
                            <th>LOCALIDAD</th>
                            <th>WHATSAPP</th>
                            <th>ACCIONES</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>32834009</td>
                            <td>ANA</td>
                            <td>GONZALEZ</td>
                            <td>MONTIEL 23</td>
                            <td>PARANA</td>
                            <td>343465232</td>
                            <td>        
                            <a href="#" name="whatsApp" class="btn whatsApp" title="whatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                            <a href="#" name="Editar" class="btn editar" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button class="btn btn eliminar" title="Eliminar" id=" " value= ' '><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                    </tbody>
                   
                </table>
            </div>
         
       </div>


</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong> Agregar Alumno </strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body cuerpo_modal">
        <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">Nombre</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        </div>
        <br>
        <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">Apellido</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        </div>
        <br>
        <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">DNI</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        </div>
        <br>
        <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">Dirreción</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        </div>
        <br>
        <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">Localidad</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        </div>
        <br>
        <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">WhatsApp</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
        </div>
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>




<script>

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
        language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    } );
} );


</script>



@endsection 
