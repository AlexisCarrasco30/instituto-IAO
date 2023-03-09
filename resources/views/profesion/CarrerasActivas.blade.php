@extends('layouts.menu')

<style>

</style>
@section('contenido')
<div class="container">
    <div class="text-center p-4">
        <h1>Carreras</h1>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" title="Agregar Carrera" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-graduation-cap"></i> Agregar Carreras  
        </button>
        
        </div>
        <div class="col-12 p-3"></div>
    </div>
       <div class="row">
          <div class="col-12">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>PRECIO-MATRICULA</th>
                            <th>PLAN DE ESTUDIO</th>
                            <th>DURACIÓN</th>
                            <th>ACCIONES</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>SECUNDARIA</td>
                            <td>2500</td>
                            <td>PLAN 2023</td>
                            <td>2 AÑOS</td>
                            <td>        
                                <a href="#" name="verMaterias" class="btn verMaterias" title="ver Materias"><i class="fa-solid fa-book"></i></a>
                            <a href="#" name="verAlumnos" class="btn verAlumnos" title="verAlumnos"><i class="fa-solid fa-eye"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel"><strong>Agregar Carrera </strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body cuerpo_modal">
        <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">Nombre</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="secundaria">
        </div>
        <br>
        <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">Precio Matricula</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="$...">
        </div>
        <br>
        <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">Plan de Estudio</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="plan 2023">
        </div>
        <br>
        <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">Duración</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="1 año">
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
