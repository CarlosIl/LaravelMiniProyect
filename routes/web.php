<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;

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

Route::resource('/', StudentController::class);

Route::resource('students', StudentController::class);

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

Route::post('/login', [LoginController::class, 'login']);

// Route::get('/home', [HomeController::class, 'index']);

Route::get('/logout', [LogoutController::class, 'logout']);

//Vista usuario normal
Route::get('/verstu', [StudentController::class, 'indexUser']);