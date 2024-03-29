<?php

use App\Http\Controllers\AnunciosController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DescontosController;
use App\Http\Controllers\EmpresasParceirasController;
use App\Http\Controllers\EntidadesController;
use App\Http\Controllers\ImagemController;
use App\Http\Controllers\ImagensController;
use App\Http\Controllers\ParcelamentosController;
use App\Http\Controllers\ProdutosController;
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

Route::get('imagens/upload', [ImagemController::class, 'upload'])->name('imagem.upload');

Route::get('entidades/formulario', [EntidadesController::class, 'formulario'])->name('entidades.form');
Route::post('entidades/enviar-formulario', [EntidadesController::class, 'enviar_formulario'])->name('entidades.send');
Route::put('entidades/enviar-formulario/{id?}', [EntidadesController::class, 'atualizar_formulario'])->name('entidades.update');
Route::get('sobrenos/{id?}', [EntidadesController::class, 'show'])->name('entidades.show');

Route::post('adicionar-item', [CarrinhoController::class, 'adicionar_item'])->name('carrinho.adicionar');
Route::put('alterar-quantidade', [CarrinhoController::class, 'alterar_quantidade'])->name('carrinho.alterar');
Route::put('alterar-quantidade', [CarrinhoController::class, 'alterar_quantidade'])->name('carrinho.alterar');
Route::get('remover-item/{produto_id}', [CarrinhoController::class, 'remover_item'])->name('carrinho.remover');
Route::get('limpar-carrinho', [CarrinhoController::class, 'limpar_carrinho'])->name('carrinho.limpar');

Route::delete('imagens-produtos/{produto_id}/{nome_imagem}', [ImagensController::class, 'destroy_imagens_produtos']);
Route::get('subcategorias/find/{categoria_id}', [SubcategoriasController::class, 'find']);

Route::get('produtos/promocoes', [ProdutosController::class, 'index_promocoes'])
    ->name('produtos.promocoes');
Route::get('produtos/encontrar/pesquisar', [ProdutosController::class, 'encontrar_por_pesquisa'])
    ->name('produtos.encontrar.pesquisa');
Route::get('produtos/encontrar/filtro', [ProdutosController::class, 'encontrar_por_filtro'])
    ->name('produtos.encontrar.filtro');
Route::get('produtos/ordenacao/{tipo}', [ProdutosController::class, 'ordenacao'])
    ->name('produtos.ordenacao');

Route::get('carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');

Route::resource('categorias', CategoriasController::class);
Route::resource('subcategorias', SubcategoriasController::class);
Route::resource('empresas_parceiras', EmpresasParceirasController::class);
Route::resource('descontos', DescontosController::class);
Route::resource('parcelamentos', ParcelamentosController::class);
Route::resource('produtos', ProdutosController::class);
Route::resource('anuncios', AnunciosController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
