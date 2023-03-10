<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/mensajes', function () {
    return view('mensaje.mensajes');
});
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/index', function () {
    return view('home') ;
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas de loguin y usuarios
    Auth::routes();

//Rutas "Alumno" controlador "PersonaController"
    Route::post('/Store/Alumno',         [App\Http\Controllers\PersonaController::class, 'StoreAlumno'        ]);
    Route::post('/Update/Alumno/{id}',   [App\Http\Controllers\PersonaController::class, 'UpdateAlumno'       ]);
    Route::get ('/Alumnos/Activos',      [App\Http\Controllers\PersonaController::class, 'AlumnosActivos'     ]);
    Route::get ('/Alumnos/Inactivos',    [App\Http\Controllers\PersonaController::class, 'AlumnosInactivos'   ]);
    Route::get ('/Alumnos/Corporativos', [App\Http\Controllers\PersonaController::class, 'AlumnosCorporativos']);
    Route::get ('/Alumnos/Secundaria',   [App\Http\Controllers\PersonaController::class, 'AlumnosSecundaria'  ]);
    Route::get ('/Alumnos/Cursos',       [App\Http\Controllers\PersonaController::class, 'AlumnosCursos'      ]);
    Route::get ('/Alumnos/Ultimos',      [App\Http\Controllers\PersonaController::class, 'AlumnosUltimos'     ]);
    Route::get ('/Edit/Alumno/{id}',     [App\Http\Controllers\PersonaController::class, 'EditAlumno'         ]);
    Route::get ('/Baja/Alumno/{id}',     [App\Http\Controllers\PersonaController::class, 'bajaAlumno'         ]);
    Route::get ('/Activar/Alumno/{id}',  [App\Http\Controllers\PersonaController::class, 'ActivarAlumno'      ]);
    
   //Rutas "Persona"   
    Route::post('/Buscar/Dni',          [App\Http\Controllers\PersonaController::class, 'BuscarDni']);

//Rutas "Telefono" controlador "TelefonoController"
    Route::post('/Store/Telefono/{id}',  [App\Http\Controllers\TelefonoController::class, 'StoreTelefono' ]);
    Route::post('/Update/Telefono/{id}', [App\Http\Controllers\TelefonoController::class, 'UpdateTelefono']);
    Route::get ('/Telefonos',            [App\Http\Controllers\TelefonoController::class, 'Telefonos'     ]);
    Route::get ('/Sus/Telefonos/{id}',   [App\Http\Controllers\TelefonoController::class, 'SusTelefonos'  ]);
    Route::get ('/Edit/Telefono/{id}',   [App\Http\Controllers\TelefonoController::class, 'EditTelefono'  ]);
    Route::get ('/Create/Telefono',      [App\Http\Controllers\TelefonoController::class, 'CreateTelefono']);
    Route::get ('/Baja/Telefono/{id}',   [App\Http\Controllers\TelefonoController::class, 'BajaTelefono'  ]);

//Rutas "Profesion" controlador "ProfesionController"   
    Route::post('/Store/Profesion/{id}',    [App\Http\Controllers\ProfesionController::class, 'StoreProfesion'       ]);
    Route::post('/Update/Profesion/{id}',   [App\Http\Controllers\ProfesionController::class, 'UpdateProfesion'      ]);
    Route::get ('/Profesiones/Ultimas/{id}',[App\Http\Controllers\ProfesionController::class, 'ProfesionesUltimas'   ]);
  //Rutas "carreras" controlador "ProfesionController" 
    Route::get ('/Carreras/Activas',        [App\Http\Controllers\ProfesionController::class, 'CarrerasActivas'      ]);
  //Rutas "cursos" controlador "profesionController"
    Route::get ('/Cursos/Activos',          [App\Http\Controllers\ProfesionController::class, 'CursosActivos'        ]);
    
    Route::get ('/Profesiones/Inactivas',   [App\Http\Controllers\ProfesionController::class, 'ProfesionesInactivas' ]);
    
    Route::get ('/Profesiones/Historicas',  [App\Http\Controllers\ProfesionController::class, 'ProfesionesHistoricas']);
    Route::get ('/Edit/Profesion/{id}',     [App\Http\Controllers\ProfesionController::class, 'EditProfesion'        ]);
    Route::get ('/Create/Profesion/{id}',   [App\Http\Controllers\ProfesionController::class, 'CreateProfesion'      ]); //El id indica que tipo de profecion(carreta o curso)
    Route::get ('/Baja/Profesion/{id}',     [App\Http\Controllers\ProfesionController::class, 'BajaProfesion'        ]);

//Rutas "Materia" controlador "MateriaController"    
    Route::post('/Store/Materia/{id}',   [App\Http\Controllers\MateriaController::class, 'StoreMateria'   ]);
    Route::post('/Update/Materia/{id}',  [App\Http\Controllers\MateriaController::class, 'UpdateMateria'  ]);
    Route::get ('/Materias/{id}',        [App\Http\Controllers\MateriaController::class, 'Materias'       ]);
    Route::get ('/Materias/Ultimas{id}', [App\Http\Controllers\MateriaController::class, 'MateriasUltimas']);
    Route::get ('/Edit/Materia/{id}',    [App\Http\Controllers\MateriaController::class, 'EditMateria'    ]);
    Route::get ('/Create/Materia/{id}',  [App\Http\Controllers\MateriaController::class, 'CreateMateria'  ]);
    Route::get ('/Baja/Materia/{id}',    [App\Http\Controllers\MateriaController::class, 'BajaMateria'    ]);

//Rutas "Inscripcion" controlador "InscripcionController"
    Route::post('/Store/Inscripcion',              [App\Http\Controllers\InscripcionController::class, 'StoreInscripcion'           ]);
    Route::post('/UpdateInscripcion/{id}',         [App\Http\Controllers\InscripcionController::class, 'UpdateInscripcion'          ]);
    Route::post('/Buscar/Profesion/Incriptas/DNI', [App\Http\Controllers\InscripcionController::class, 'BuscarProfesionIncriptasDni']);
    Route::get ('/Inscripciones',                  [App\Http\Controllers\InscripcionController::class, 'Incripciones'               ]);
    Route::get ('/Incripciones/Ultimas',           [App\Http\Controllers\InscripcionController::class, 'IncripcionesUltimas'        ]);
    Route::get ('/Create/Inscripcion',             [App\Http\Controllers\InscripcionController::class, 'CreateInscripcion'          ]);
    Route::get ('/Edit/Inscripcion/{id}',          [App\Http\Controllers\InscripcionController::class, 'EditInscripcion'            ]);
    Route::get ('/Baja/Incripcion/{id}',           [App\Http\Controllers\InscripcionController::class, 'BajaIncripcion'             ]);
    
//Rutas "Pago" controlador "PagoController"
    Route::get ('/Pagos',            [App\Http\Controllers\InscripcionController::class, 'Pagos'          ]);
    Route::post('/Meses/Pendientes', [App\Http\Controllers\InscripcionController::class, 'MesesPendientes']);





    
    
    
    

    





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
