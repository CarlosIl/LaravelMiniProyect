<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LookoutController;
use App\Http\Controllers\TurnoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'show']);

// Route::resource('students', StudentController::class);
// Route::get('index', [StudentController::class,'index']) ->name('home');
// Route::get('categoria', [CategoriaController::class,'index']) ->name('categoria');

//CATEGORIAS
Route::resource('categorias', CategoriaController::class);

//Para PDF
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

//Para página registro
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

//Para página login
Route::get('/login', [LoginController::class, 'show']);
//Poner name para arreglar error de redirección login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Route::get('/home', [HomeController::class, 'index']);

//Desloguearse
Route::get('/logout', [LogoutController::class, 'logout']);


//Vista usuario normal
Route::middleware(['auth','user-access:user'])->group(function(){
    Route::get('/verstu', [StudentController::class, 'indexUser']);
});

//Vista administrador
Route::middleware(['auth','user-access:admin'])->group(function(){
    Route::resource('students', StudentController::class);
});

//FICHEROS

//Ir al index de los ficheros
Route::get('/files/{student}', [FileController::class, 'index'])->name('files.index');

//Mostrar y descargar ficheros
Route::get('/files/show/{student}', [FileController::class, 'show'])->name('files.show');
Route::post('/files/download', [FileController::class, 'download'])->name('files.download');

//Crear y almacenar ficheros
Route::get('/files/create/{student}', [FileController::class, 'create'])->name('files.create');
Route::post('/files/store', [FileController::class, 'store'])->name('files.store');

//Mostrar y eliminar ficheros
Route::get('/files/delete/{student}', [FileController::class, 'delete'])->name('files.delete');
Route::post('/files/destroy', [FileController::class, 'destroy'])->name('files.destroy');


//TURNOS

//Ir al index de turnos sin mostrar nada
Route::get('/turnos', [TurnoController::class, 'index'])->name('turno.index');

//Ir al index de turnos creando un nuevo turno
Route::post('/turnos/crear', [TurnoController::class, 'crearTurno'])->name('turno.crear');

//Buscar turno
Route::get('/turnos/buscar', [TurnoController::class, 'buscarTurno'])->name('turno.buscar');

//Ir al index de turnos con el turno seleccionado
Route::get('/turnos/{turno_choose}/select', [TurnoController::class, 'seleccionarTurno'])->name('turno.seleccionar');

//Ir a crear dia
Route::get('/turnos/{turno_choose}/dia', [TurnoController::class, 'crearDia'])->name('turno.dia');

//Buscar horario
Route::get('/turnos/{turno_choose}/horario', [TurnoController::class, 'buscarHorario'])->name('turno.horario');

//Ir a crear dia con un horario seleccionado
Route::get('/turnos/{turno_choose}/horario/{horario_choose}/select', [TurnoController::class, 'seleccionarHorario'])->name('turno.horario.seleccionar');

//Volver a index de turnos con ese turno y con un día creado 
Route::post('/turnos/{turno_choose}/dia/crear', [TurnoController::class, 'guardarDia'])->name('turno.dia.crear');

//Ir al index de turnos con el turno seleccionado
Route::get('/turnos/{turno_choose}/editar', [TurnoController::class, 'editarTurno'])->name('turno.editar');

//Volver a index de turnos con ese turno y editado 
Route::post('/turnos/actualizar', [TurnoController::class, 'actualizarTurno'])->name('turno.actualizar');

//Ir al index de turnos con el turno seleccionado
Route::get('/turnos/{turno_choose}/eliminar', [TurnoController::class, 'eliminarTurno'])->name('turno.eliminar');

//Volver a index de turnos con ese turno y editado 
Route::post('/turnos/busqueda', [TurnoController::class, 'busquedaDeTurno'])->name('turno.busqueda');

//Volver a index de turnos con ese turno y con un día eliminado 
Route::get('/turnos/{turno_choose}/dia/eliminar', [TurnoController::class, 'eliminarDia'])->name('turno.dia.eliminar');

//Volver a index de turnos con ese turno y editado 
Route::post('/turnos/{turno_choose}/horario/busqueda', [TurnoController::class, 'busquedaDeHorario'])->name('turno.horario.busqueda');