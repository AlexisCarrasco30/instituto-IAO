@extends('layouts.menu')

@section('contenido')
<div class="container">
    @if (str_contains(url()->current(), '/Inactivas'))
        <div class="text-center p-4">
            <h1>Materias Inactivas</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <a type="button" class="btn btn-primary" title="Agregar Materia" href="/Materias/{{$idProfesion}}">
                     Materias Activas 
                </a>
            </div>
            <div class="col-12 p-3"></div>
        </div>
    @else
        <div class="text-center p-4">
            <h1>Materias</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Button trigger modal -->
            <button type="button" id="agregarMateria" class="btn btn-primary" title="Agregar Materia" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-book"></i> Agregar Materias 
            </button>

            <a type="button" class="btn btn-primary" title="Agregar Materia" href="/Materias/Inactivas/{{$idProfesion}}">
                 Materias Inactivas 
            </a>
            </div>
            <div class="col-12 p-3"></div>
        </div>
    @endif
    
       <div class="row">
          <div class="col-12">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>DURACIÓN</th>
                            <th>MATERIAL-LINK</th>
                            <th>ACCIONES</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materias as $materia)
                            <tr>
                                <td>{{$materia->nombre}}</td>
                                <td>{{$materia->duracion}}</td>
                                <td><a href="{{$materia->temas}}">{{$materia->temas}}</a></td>
                                <td>
                                    @if (str_contains(url()->current(), '/Inactivas'))
                                        <button class="btn activar" title="Activar" id="{{$materia->id}}" value= '{{$materia->id}}'><i class="fa-solid fa-plus"></i></button>
                                    @else
                                        {{-- <a href="#" name="verMaterias" class="btn verMaterias" title="ver Materias"><i class="fa-solid fa-book"></i></a>
                                        <a href="#" name="verAlumnos" class="btn verAlumnos" title="verAlumnos"><i class="fa-solid fa-eye"></i></a> --}}
                                        <button type="button" class=" btn btn modalEditar" title="Editar Materia" data-bs-toggle="modal" data-bs-target="#exampleModal" id ='{{$materia->id}}Modal' value= '{{$materia->id}}'><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn btn eliminar" title="Eliminar" id="{{$materia->id}}" value= '{{$materia->id}}'><i class="fa-solid fa-trash-can"></i></button>
                                    @endif        
                                    
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
                <h5 class="modal-title" id="exampleModalLabel"><strong id= 'tituloModal'></strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method ="POST" id="formulario" name="formulario">
                @csrf
                <div class="modal-body cuerpo_modal">
                    <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Nombre</span>
                    <input type="text" id="nombreMateria" name="nombre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="quimica,matematica,fisica...">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Duración</span>
                    <input type="text" id="duracion" name="duracion" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="1 año...">
                    </div>
                    <br>
                
                    <div class="input-group input-group-lg">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Material-link</span>
                    <input type="text" id="material-link" name="temas" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="https://drive.com/material">
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id ="botonGuardar">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- script de aler sweet -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- inicializacion de data table -->
<script>

$(document).ready(function() {
    $('#example').DataTable( {
        "bSort": true, // Con esto le estás diciendo que se pueda ordenar, ponlo a 'true'
        "order": [], // Aquí le dices que el criterio de ordenación primero esté vació , o lo que es lo mismo, ninguno
        responsive:true, 
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
        let agregarMateria =  document.getElementById('agregarMateria');
        agregarMateria.addEventListener('click', function(){
                
            document.getElementById('tituloModal').innerHTML ="Agregar Materia";

           // limpieza
            let nombreMateria   = document.getElementById('nombreMateria');
            nombreMateria.value = '';
            document.getElementById('duracion').value    ='';
            document.getElementById('material-link').value  ='';

            let formulario    = document.getElementById('formulario');
            formulario.action = '/Store/Materia/'+ @json($idProfesion);

           //Busqueda de que no ingrese un alumno que ya esta
            nombreMateria.addEventListener('keyup', function(){

                let MateriasBusq      = @json($materias);
                let cantMaterias      = MateriasBusq.length;
                let cantMateria       = nombreMateria.value.length;
                let botonGuardar      = document.getElementById('botonGuardar');
                botonGuardar.disabled = false;

                for (let y=0; y < cantMaterias ; y++){

                    if(MateriasBusq[y].nombre == nombreMateria.value){

                        Swal.fire("La Materia: "+MateriasBusq[y].nombre+" ya se encuentra registrada");
                        botonGuardar.disabled = true;

                    }
                }
                
            })    
        })            
        </script>

<!-- Ordenamiento boton class modaledit e ingreso de datos -->
  <script>
        let id = 0;
        let botonesModal  = document.getElementsByClassName("modalEditar");
        let botonModal    = [];
        let cantidad      = botonesModal.length;
        let materias       = @json($materias);
        let cantMaterias    = materias.length;

        let formulario = document.getElementById('formulario');
        let tituloModal = document.getElementById('tituloModal');
        let nombreMateria = document.getElementById('nombreMateria');
        let duracion = document.getElementById('duracion');
        let temas = document.getElementById('material-link');
        
        for(let i = 0; i < cantidad; i++){
        
          id            = botonesModal[i].id;
          botonModal[i] = document.getElementById(`${id}`);

          botonModal[i].addEventListener('click', function(){
                for(let x = 0; x < cantMaterias; x++){
                    
                    if(materias[x].id == botonModal[i].value){
                        console.log("entró");

                       // ingreso los datos de la materia y paso el modal a modo edicion
                        formulario.action     = '/Update/Materia/'+materias[x].id;
                        tituloModal.innerHTML = "Editar Materia";
                        nombreMateria.value   = materias[x].nombre;
                        duracion.value        = materias[x].duracion;
                        temas.value           = materias[x].temas;

                    }
                    //x = cantAlumno;
                    }
                });
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
                    
                        let cod        = boton[i].value;
                        let materias    = @json($materias);
                        let cantMaterias = materias.length;
                        let nombre ='';

                        for(let x = 0; x < cantMaterias; x++){
                            if(materias[x].id == boton[i].value){
                                nombre = materias[x].nombre;
                                //x = cantAlumno;
                            }
                        }
                        Swal.fire({
                            title: 'Esta Seguro que desea Borrar la materia '+nombre+'?',
                            text: "Recuerde que esta materia se asentará en materias inactivas. Confirme la decisión!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar'

                         }).then((result) => {
                     if (result.isConfirmed) {

                        location.href ='/Baja/Materia/'+cod

                          }
                        })

                     });
                    }
  </script>

  <!-- ordemanimiento de boton activar -->
  <script>
    var idActivar  = 0;
    var botones = document.getElementsByClassName("activar");
    var boton   = [];
    let cantidadActivar = botones.length;
        for(let i = 0; i < cantidadActivar; i++){
              idActivar = botones[i].id;
              boton[i]= document.getElementById(`${idActivar}`);
            
              boton[i].addEventListener('click', function(){
                
                    let cod        = boton[i].value;
                    let materias    = @json($materias);
                    let cantMaterias = materias.length;
                    let nombre ='';

                    for(let x = 0; x < cantMaterias; x++){
                        if(materias[x].id == boton[i].value){
                            nombre = materias[x].nombre;
                            //x = cantAlumno;
                        }
                    }
                    Swal.fire({
                        title: 'Esta Seguro que desea Activar la materia '+nombre+'?',
                        text: "Recuerde que esta materia se asentará en materias activas. Confirme la decisión!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, activar'

                     }).then((result) => {
                 if (result.isConfirmed) {

                    location.href ='/Activar/Materia/'+cod

                      }
                    })

                 });
                }
</script>

@endsection

