@extends('layouts.menu')


@section('contenido')
<style>
.categoria{
display: flex;
justify-content: end;
padding-top:.-10px !important;

}
.dt-button{

  margin: 10px !important;
  background-color:#0191ca !important;
  color: #ffffff!important;
border-radius: 10px !important;
}  

</style>

<div class="container">
    <div class="text-center p-4">
        <h1>Alumnos Activos</h1>
    </div>
  
    <div class="row">
            <div class="col-md-6 col-xs-12 text-start">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" title="Agregar Alumno" data-bs-toggle="modal" data-bs-target="#exampleModal" id ='agregarAlumno'>
                <i class="fa-solid fa-user-plus"></i> Agregar Alumno
                </button>
                </div>
            <div class="col-md-6 col-xs-12 text-end">
                <button type="button" class="btn btn-primary" title="Agregar Alumno" data-bs-toggle="modal" data-bs-target="#exampleModalCategoria" id ='agregarAlumno'>
                    <i class="fa-solid fa-list"></i> Agregar Categoria
                </button>
             </div>
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
                    @foreach($alumnos as $unAlumno)
                        <tr>
                            <td>{{$unAlumno->dni}}</td>
                            <td>{{$unAlumno->nombre}}</td>
                            <td>{{$unAlumno->apellido}}</td>
                            <td>{{$unAlumno->direccion}}</td>
                            <td>{{$unAlumno->localidad}}</td>
                            <td>{{$unAlumno->numero}}</td>
                            <td>
                                <a href="#" name="whatsApp" class="btn whatsApp" title="whatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                                <button type="button" class=" btn btn modalEditar" title="EditarAlumno" data-bs-toggle="modal" data-bs-target="#exampleModal" id ='{{$unAlumno->id}}Modal' value= '{{$unAlumno->id}}'><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn eliminar" title="Eliminar" id="{{$unAlumno->id}}" value= '{{$unAlumno->id}}'><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
       </div>
</div>



<!-- Modal Alumnos -->
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
                <span class="input-group-text" id="inputGroup-sizing-lg">DNI</span>
                <input type="text" class="form-control" name= 'dni' id= 'dni' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Nombre</span>
                <input type="text" class="form-control" name= 'nombre' id= 'nombre' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Apellido</span>
                <input type="text" class="form-control" name= 'apellido' id= 'apellido' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Dirección</span>
                <input type="text" class="form-control" name= 'direccion' id= 'direccion' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Localidad</span>
                <input type="text" class="form-control" name= 'localidad' id= 'localidad' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">WhatsApp</span>
                <input type="number" class="form-control" name= 'celular' id= 'celular'aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Tipo de alumno</span>
                <select  id='clasificacion' class="form-control" name="clasificacion">
                @foreach($clasificacion as $unaClasificacion)
                    <option  id ="{{$unaClasificacion->id}}" value = "{{$unaClasificacion->id}}" class="seleccion">{{$unaClasificacion->descripcion}}</option>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                @endforeach
                </select>
            </div>
            <br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit"  class="btn btn-primary" id ="botonGuardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Categorias-->
<div class="modal fade" id="exampleModalCategoria" tabindex="-1" aria-labelledby="exampleModalLabelCategoria" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong id= 'tituloModal'><strong> Categoría</strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method ="POST" id="formulario" name="formulario">
        @csrf
          <div class="modal-body cuerpo_modal">
          
              <div class="input-group input-group-lg">
                  <span class="input-group-text" id="inputGroup-sizing-lg">Nombre </span>
                  <input type="text" class="form-control" name= 'nombreCategoria' id= 'nombreCategoria' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="De la categoría">
              </div>
              <br>
              <div class="input-group input-group-lg">
                  <span class="input-group-text" id="inputGroup-sizing-lg">Corporativo</span>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                    </option>
                  </select>
              </div>
              <br>
             
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">Precio de Matricula</span>
                <input type="text" class="form-control" name= 'precioMatricula' id= 'precioMatricula'aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
            </div>
              </div>
            
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit"  class="btn btn-primary" id ="botonGuardar">Guardar</button>
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
        let agregarAlumno =  document.getElementById('agregarAlumno');
        agregarAlumno.addEventListener('click', function(){
                
            document.getElementById('tituloModal').innerHTML ="Agregar Alumno";

           // limpieza
            let botonDni   = document.getElementById('dni');
            botonDni.value = '';
            document.getElementById('nombre').value    ='';
            document.getElementById('apellido').value  ='';
            document.getElementById('direccion').value ='';
            document.getElementById('localidad').value ='';
            document.getElementById('celular').value   ='';

            let formulario    = document.getElementById('formulario');
            formulario.action = '/Store/Alumno';

           //Busqueda de que no ingrese un alumno que ya esta
            botonDni.addEventListener('keyup', function(){

                let AlumnosBusq       = @json($alumnos);
                let cantAlum          = AlumnosBusq.length;
                let cantDni           = botonDni.value.length;
                let botonGuardar      = document.getElementById('botonGuardar');
                botonGuardar.disabled = false;

                if(cantDni >5){

                    for (let y=0; y < cantAlum ; y++){

                        if(AlumnosBusq[y].dni == botonDni.value){

                            Swal.fire("El alumno Dni: "+AlumnosBusq[y].dni+" "+AlumnosBusq[y].apellido+" "+AlumnosBusq[y].nombre+" ya se encuentra registrado");
                            botonGuardar.disabled = true;
                        }
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
        let alumnos       = @json($alumnos);
        let cantAlumno    = alumnos.length;
        
        for(let i = 0; i < cantidad; i++){
        
          id            = botonesModal[i].id;
          botonModal[i] = document.getElementById(`${id}`);

          botonModal[i].addEventListener('click', function(){
                for(let x = 0; x < cantAlumno; x++){
                    
                    if(alumnos[x].id == botonModal[i].value){

                       // ingreso los datos del alumno y paso el modal a modo edicion
                        document.getElementById('formulario').action     = '/Update/Alumno/'+alumnos[x].id;
                        document.getElementById('tituloModal').innerHTML ="Editar Alumno";
                        document.getElementById('nombre').value          = alumnos[x].nombre;
                        document.getElementById('apellido').value        = alumnos[x].apellido;
                        document.getElementById('dni').value             = alumnos[x].dni;
                        document.getElementById('direccion').value       = alumnos[x].direccion;
                        document.getElementById('localidad').value       = alumnos[x].localidad;
                        document.getElementById('celular').value         = alumnos[x].numero;

                        let seleccion    = document.getElementsByClassName('seleccion') 
                        let cantOpciones = seleccion.length;

                        for(let j = 0; j < cantOpciones; j++){
                            if(seleccion[j].value == alumnos[x].idClasificacion ){

                                console.log(seleccion[j].value);
                                console.log(alumnos[x].idClasificacion);
                                seleccion[j].selected = true;
                                j = cantOpciones;
                            }
                        }
                    x = cantAlumno;
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
                    
                        let cod        = boton[i].value;
                        let alumnos    = @json($alumnos);
                        let cantAlumno = alumnos.length;
                        let nombre ='';

                        for(let x = 0; x < cantAlumno; x++){
                            if(alumnos[x].id == boton[i].value){
                                nombre = alumnos[x].nombre +' '+ alumnos[x].apellido;
                                x = cantAlumno;
                            }
                        }
                        Swal.fire({
                            title: 'Esta Seguro que desea Borrar al alumno '+nombre+'?',
                            text: "confirme la decisión!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar'

                         }).then((result) => {
                     if (result.isConfirmed) {

                        location.href ='/Baja/Alumno/'+cod

                          }
                        })

                     });
                    }
  </script>

@endsection
