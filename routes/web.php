<?php

use App\Ingrediente;
use App\Prato;
use App\User;

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
Auth::routes();

//-------------------ROTAS PRATOS-------------------------------------------------------------
Route::get('/', 'PratoController@buscarPratos')->name('pratos.buscar')->middleware('auth');

Route::get('/cardapio/new', function() {

    $ingredientes = Ingrediente::all();

    return view('pratos.adicionar', ['ingredientes' => $ingredientes]);
})->name('pratos.adicionarView')->middleware('auth');

Route::post('/cardapio/new/save', 'PratoController@adicionarPrato')->name('pratos.adicionar')->middleware('auth');

Route::get('/cardapio/edit/{id}', function($id) {

    $prato = Prato::findOrFail($id);
    $ingredientes = Ingrediente::all();

    return view('pratos.editar', ['prato' => $prato, 'ingredientes' => $ingredientes]);
})->name('pratos.editarView')->middleware('auth');

Route::put('/cardapio/edit/save', 'PratoController@atualizarPrato')->name('pratos.editarSave')->middleware('auth');

Route::get('/cardapio/deletar/{id}', 'PratoController@removerPrato')->name('pratos.deletar')->middleware('auth');

//-------------------ROTAS INGREDIENTES-------------------------------------------------------
Route::get('/ingredientes', 'IngredienteController@buscarIngredientes')->name('ingrediente.buscar')->middleware('auth');

Route::get('/ingrediente/editar', 'IngredienteController@buscarViewEditar')->name('ingrediente.editarView')->middleware('auth');

Route::post('/novoingrediente', 'IngredienteController@novoIngrediente')->name('ingrediente.inserir')->middleware('auth');

Route::put('/ingrediente/editar/save', 'IngredienteController@editarIngrediente')->name('ingrediente.editar')->middleware('auth');

Route::delete('/removerIngrediente', 'IngredienteController@removerIngrediente')->name('ingrediente.remover')->middleware('auth');

//-------------------ROTAS PEDIDO-------------------------------------------------------------
Route::get('/pedidos', 'PedidoController@mostrarPedidos')->name('pedidos.buscar')->middleware('auth');

Route::get('/pedidos/new', function() {

    $pratos = Prato::all();

    return view('pedidos.new', ['pratos' => $pratos]);
})->name('pedidos.novo')->middleware('auth');

Route::post('/pedidos/new/save', 'PedidoController@realizarPedido')->name('pedidos.novoSalvar')->middleware('auth');

Route::get('/pedidos/preparar/{id}', 'PedidoController@comecarPreparo')->name('pedidos.preparar')->middleware('auth');

Route::get('/pedidos/concluir/{id}', 'PedidoController@finalizarPedido')->name('pedidos.concluir')->middleware('auth');

Route::get('/teste', function() {

    return view('layout');
});

//-------------------ROTAS RELATORIOS-----------------------------------------------------------
Route::get('/relatorios', 'UserController@desempenhoGeral')->name('relatorio.index')->middleware('auth');

Route::get('/relatorio/garcom', 'UserController@desempenhoGarcom')->name('relatorio.garcom')->middleware('auth');

Route::get('/relatorio/cozinheiro', 'UserController@desempenhoCozinheiro')->name('relatorio.cozinheiro')->middleware('auth');
//------------------ROTAS ADMINISTRACAO USUARIOS------------------------------------------------
Route::get('/administracao', 'UserController@index')->name('administracao.index')->middleware('auth');

Route::get('/administracao/editar', 'UserController@buscarUsuarioEdicao')->name('administracao.buscarEdicao')->middleware('auth');

Route::get('/administracao/meususuarios', 'UserController@buscarUsuarios')->name('administracao.busca')->middleware('auth');

Route::post('/administracao/cadastrar', 'UserController@cadastrarUsuario')->name('administracao.cadastrar')->middleware('auth');

Route::put('/administracao/editar/save', 'UserController@editarUsuario')->name('administracao.editar')->middleware('auth');

Route::delete('/administracao/excluir/{id}', 'UserController@excluirUsuario')->name('administracao.excluir')->middleware('auth');
//----------------------------------------------------------------------------------------------