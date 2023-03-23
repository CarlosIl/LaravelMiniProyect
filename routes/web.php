<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LookoutController;
use App\Http\Controllers\StudentFileController;

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

Route::get('/logout', [LogoutController::class, 'logout']);

//Vista usuario normal
// Route::get('/verstu', [StudentController::class, 'indexUser']);

Route::middleware(['auth','user-access:user'])->group(function(){
    Route::get('/verstu', [StudentController::class, 'indexUser']);
});

Route::middleware(['auth','user-access:admin'])->group(function(){
    Route::resource('students', StudentController::class);
});

Route::get('/ftp', function () {
    return view('pruebas.prueba1');
});

Route::post('/ftp', [LookoutController::class, 'store']);

// Route::get('/descargar/{fichero}', [StudentController::class, 'descargarArchivo'])->name('fichero');

Route::resource('studentfiles', StudentFileController::class);

Route::get('/addFile/{student}', [StudentController::class, 'addFile'])->name('addFile');

Route::post('/addFile', [StudentController::class, 'createFile'])->name('createFile');

Route::get('/deleteFile/{student}', [StudentController::class, 'deleteFile'])->name('deleteFile');

Route::post('/deleteFile', [StudentController::class, 'destroyFile'])->name('destroyFile');

Route::get('/downFile/{student}', [StudentController::class, 'showFile'])->name('showFile');

Route::post('/downFile', [StudentController::class, 'downFile'])->name('downFile');