<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoriaController;
use App\Models\Categoria;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegisterController;

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

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

Route::get('/register', [RegisterController::class, 'show']);

Route::post('/register', [RegisterController::class, 'register']);