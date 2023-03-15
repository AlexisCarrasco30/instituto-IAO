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
.verMaterias{
    color:green !important; 
}
.verMaterias:hover{
    color:black!important;
}
.editar{
    color:blue!important; 
}
.editar:hover{
    color:black !important;
}
.verAlumnos{
    color:cyan!important; 
}
.verAlumnos:hover{
    color:black !important;
}
</style>
@section('contenido')

<div class="container">
    <div class="text-center p-4">
        <h1>Secundarias</h1>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Button trigger modal -->
        <button type="button" id= "agregarCarrera" class="btn btn-primary" title="Agregar Carrera" data-bs-toggle="modal" data-bs-target="#exampleModal" >
            <i class="fa-solid fa-graduation-cap"></i> Agregar Secundaria  
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
                    @foreach($secundaria as $unaSecundaria)
                        <tr>
                            <td>{{$unaSecundaria->titulo}}</td>
                            <td>{{$unaSecundaria->precioMatricula}}</td>
                            <td>{{$unaSecundaria->planEstudio}}</td>
                            <td>{{$unaSecundaria->duracion}}</td>
                            <td>        
                                <a href="/Materias/{{$unaSecundaria->id}}" name="verMaterias" class="btn verMaterias" title="ver Materias"><i class="fa-solid fa-book"></i></a>
                                <a href="#" name="verAlumnos" class="btn verAlumnos" title="verAlumnos"><i class="fa-solid fa-eye"></i></a>
                                <button type="button" class=" btn btn modalEditar" title="EditarAlumno" data-bs-toggle="modal" data-bs-target="#exampleModal" id ='{{$unaSecundaria->id}}Modal' value= '{{$unaSecundaria->id}}'><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn eliminar" title="Eliminar" id="{{$unaSecundaria->id}}" value= '{{$unaSecundaria->id}}'><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                    @endforeach
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
        <h5 class="modal-title" id="exampleModalLabel"><strong id ="tituloModal"></strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method ="POST" id="formulario" name="formulario">
        @csrf
        <div class="modal-body cuerpo_modal">
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Nombre</span>
                <input type="text" id="titulo" name="titulo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="secundaria">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Precio Matricula</span>
                <input type="text" id= "precioMatricula" name= "precioMatricula" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="$...">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Plan de Estudio</span>
                <input type="text" id= "planEstudio" name= "planEstudio" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="plan 2023">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Duración</span>
                <input type="text" id= "duracion" name= "duracion" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="1 año">
            </div>
            <br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "bSort": true, // Con esto le estás diciendo que se pueda ordenar, ponlo a 'true'
        "order": [], // Aquí le dices que el criterio de ordenación primero esté vació , o lo que es lo mismo, ninguno
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

<!-- limpieza  y poner modal en modo creacion-->
    <script>
        let agregarCarrera = document.getElementById('agregarCarrera');
        agregarCarrera.addEventListener('click', function(){
                
            document.getElementById('tituloModal').innerHTML ="Agregar Secundaria";

           // limpieza
            document.getElementById('titulo').value           ='';
            document.getElementById('precioMatricula').value  ='';
            document.getElementById('planEstudio').value      ='';
            document.getElementById('duracion').value         ='';

            let formulario    = document.getElementById('formulario');
            formulario.action = '/Store/Profesion/secundaria';

        })                
    </script>

<!-- Ordenamiento boton class modaledit e ingreso de datos -->
  <script>
        let id = 0;
        let botonesModal   = document.getElementsByClassName("modalEditar");
        let botonModal     = [];
        let cantidad       = botonesModal.length;
        let secundarias    = @json($secundaria);
        let cantSecundaria = secundarias.length;
        
        for(let i = 0; i < cantidad; i++){
        
          id            = botonesModal[i].id;
          botonModal[i] = document.getElementById(`${id}`);

          botonModal[i].addEventListener('click', function(){
                for(let x = 0; x < cantSecundaria; x++){
                    
                    if(secundarias[x].id == botonModal[i].value){
                        
                       // ingreso los datos del alumno y paso el modal a modo edicion
                        document.getElementById('formulario').action      = '/Update/Profesion/'+secundarias[x].id;
                        document.getElementById('tituloModal').innerHTML  = "Editar Secundaria";
                        document.getElementById('titulo').value           = secundarias[x].titulo;
                        document.getElementById('precioMatricula').value  = secundarias[x].precioMatricula;
                        document.getElementById('planEstudio').value      = secundarias[x].planEstudio;
                        document.getElementById('duracion').value         = secundarias[x].duracion;
                        
                        x = cantSecundaria;
                    }
                }
          })
        }
  </script>
  
<!-- ordemanimiento de boton delete -->
<script>
        var idEliminar  = 0;
        var botones = document.getElementsByClassName("eliminar");
        var boton   = [];
        let cantidadEliminar = botones.length;
            for(let i = 0; i < cantidadEliminar; i++){
                  idEliminar = botones[i].id;
                  boton[i]= document.getElementById(`${idEliminar}`);
                
                  boton[i].addEventListener('click', function(){
                    
                        let cod            = boton[i].value;
                        let secundaria     = @json($secundaria);
                        let cantSecundaria = secundaria.length;
                        let nombre ='';

                        for(let x = 0; x < cantSecundaria; x++){
                            if(secundaria[x].id == boton[i].value){
                                nombre = secundaria[x].titulo;
                                x = cantSecundaria;
                            }
                        }
                        Swal.fire({
                            title: 'Esta Seguro que desea borrar la secundaria '+nombre+'?',
                            text: "Recuerde que en caso de que la secundaria esten inscriptos alumnos o este relacionada con pagos se hara una baja logica. Confirme la decisión!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar'

                         }).then((result) => {
                     if (result.isConfirmed) {

                        location.href ='/Baja/Profesion/'+cod

                          }
                        })

                     });
                    }
  </script>




@endsection 
