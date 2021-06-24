<?php
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DescontosController;
use App\Http\Controllers\EmpresasParceirasController;
use App\Http\Controllers\ParcelamentosController;
use App\Http\Controllers\SubcategoriasController;
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

Route::resource('categorias', CategoriasController::class);
Route::resource('subcategorias', SubcategoriasController::class);
Route::resource('empresas_parceiras', EmpresasParceirasController::class);
Route::resource('descontos', DescontosController::class);
Route::resource('parcelamentos', ParcelamentosController::class);



