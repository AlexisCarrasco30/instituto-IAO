@extends('layouts.menu')


<style>
table th{
    background-color: #016C98 !important;
    color:#ffffff;
}
</style>
@section('contenido')

<div class="container">
    <div class="text-center p-4">
        <h1>Alumnos Inactivos</h1>
    </div>
    <div class="row">
    </div>
    <div class="row">
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
                            <button class="btn btn recuperar" title="Recuperar"  id="{{$unAlumno->id}}" value= '{{$unAlumno->id}}'><div class="text-success"><i class="fa-solid fa-user-plus"></i></div></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
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


<script>
        var id       = 0;
        var botones  = document.getElementsByClassName("recuperar");
        var boton    = [];
        let cantidad = botones.length;

            for(let i = 0; i < cantidad; i++){
                id =botones[i].id;
                boton[i]= document.getElementById(`${id}`);
                
                boton[i].addEventListener('click', function(){

                    var cod        = boton[i].value;
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
                        title: '¿ Esta Seguro que desea recuperar el alumno '+nombre+' ?',
                        text: "confirme la decisión!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'aceptar',
                        cancelButtonText: 'cancelar'
  
                    }).then((result) => {
                        
                        if (result.isConfirmed) {

                            location.href = '/Activar/Alumno/'+cod; 
                          }
                    })

                });

            }
</script>




@endsection
