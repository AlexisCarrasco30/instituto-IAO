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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//rutas de loguin y usuarios
    Auth::routes();

//Rutas "Alumno" controlador "PersonaController"
    Route::post('/Store/Alumno',        [App\Http\Controllers\PersonaController::class, 'StoreAlumno']);
    Route::post('/Update/Alumno/{id}',  [App\Http\Controllers\PersonaController::class, 'UpdateAlumno']);
    Route::get ('/Alumnos/Activos',     [App\Http\Controllers\PersonaController::class, 'AlumnosActivos']);
    Route::get ('/Alumnos/Inactivos',   [App\Http\Controllers\PersonaController::class, 'AlumnosInactivos']);
    Route::get ('/Alumnos/Ultimos',     [App\Http\Controllers\PersonaController::class, 'AlumnosUltimos']);
    Route::get ('/Create/Alumno',       [App\Http\Controllers\PersonaController::class, 'CreateAlumno']);
    Route::get ('/Edit/Alumno/{id}',    [App\Http\Controllers\PersonaController::class, 'EditAlumno']);
    Route::get ('/Baja/Alumno/{id}',    [App\Http\Controllers\PersonaController::class, 'bajaAlumno']);
    Route::get ('/Activar/Alumno/{id}', [App\Http\Controllers\PersonaController::class, 'ActivarAlumno']);
    
   //Rutas "Persona"   
    Route::post('/Buscar/Dni',          [App\Http\Controllers\PersonaController::class, 'buscarDni']);

//Rutas "Telefono" controlador "TelefonoController"
    Route::post('/Store/Telefono/{id}',  [App\Http\Controllers\TelefonoController::class, 'StoreTelefono']);
    Route::post('/Update/Telefono/{id}', [App\Http\Controllers\TelefonoController::class, 'UpdateTelefono']);
    Route::get ('/Telefonos',            [App\Http\Controllers\TelefonoController::class, 'Telefonos']);
    Route::get ('/Sus/Telefonos/{id}',   [App\Http\Controllers\TelefonoController::class, 'SusTelefonos']);
    Route::get ('/Edit/Telefono/{id}',   [App\Http\Controllers\TelefonoController::class, 'EditTelefono']);
    Route::get ('/Create/Telefono',      [App\Http\Controllers\TelefonoController::class, 'CreateTelefono']);
    Route::get ('/Baja/Telefono/{id}',   [App\Http\Controllers\TelefonoController::class, 'BajaTelefono']);

//Rutas "Profesion" controlador "ProfesionController"   
    Route::post('/Store/Profesion/{id}',   [App\Http\Controllers\ProfecionController::class, 'StoreProfesion']);
    Route::post('/Update/Profesion/{id}',  [App\Http\Controllers\ProfecionController::class, 'UpdateProfesion']);
    Route::get ('/Profesiones/Activas',    [App\Http\Controllers\ProfecionController::class, 'ProfesionesActivas']);
    Route::get ('/Profesiones/Inactivas',  [App\Http\Controllers\ProfecionController::class, 'ProfesionesInactivas']);
    Route::get ('/Profesiones/Ultimas',    [App\Http\Controllers\ProfecionController::class, 'ProfesionesUltimas']);
    Route::get ('/Profesiones/Historicas', [App\Http\Controllers\ProfecionController::class, 'ProfesionesHistoricas']);
    Route::get ('/Edit/Profesion/{id}',    [App\Http\Controllers\ProfecionController::class, 'EditProfesion']);
    Route::get ('/Create/Profesion',       [App\Http\Controllers\ProfecionController::class, 'CreateProfesion']);
    Route::get ('/Baja/Profesion/{id}',    [App\Http\Controllers\ProfecionController::class, 'BajaProfesion']);

//Rutas "Materia" controlador "MateriaController"    
    Route::post('/Store/Materia/{id}',   [App\Http\Controllers\MateriaController::class, 'StoreMateria']);
    Route::post('/Update/Materia/{id}',  [App\Http\Controllers\MateriaController::class, 'UpdateMateria']);
    Route::get ('/Materias/{id}',        [App\Http\Controllers\MateriaController::class, 'Materias']);
    Route::get ('/Materias/Ultimas{id}', [App\Http\Controllers\MateriaController::class, 'MateriasUltimas']);
    Route::get ('/Edit/Materia/{id}',    [App\Http\Controllers\MateriaController::class, 'EditMateria']);
    Route::get ('/Create/Materia/{id}',  [App\Http\Controllers\MateriaController::class, 'CreateMateria']);
    Route::get ('/Baja/Materia/{id}',    [App\Http\Controllers\MateriaController::class, 'BajaMateria']);

//Rutas "Inscripcion" controlador "InscripcionController"
        




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
