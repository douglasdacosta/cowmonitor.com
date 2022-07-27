<?php

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

use App\Http\Controllers\HistoricosController;

Auth::routes();

Route::get('/','DashboardController@index')->name('dashboard')->middleware('auth');

Route::get('/home','DashboardController@index')->name('dashboard')->middleware('auth');
Route::get('/fazenda','FazendaController@index')->name('Fazenda');
Route::get('/pesquisa-fazenda','FazendaController@pesquisar')->name('pesquisa-fazenda');
Route::match(['get', 'post'],'/inclui-fazenda','FazendaController@incluir')->name('inclui-fazenda');
Route::any('/altera-fazenda','FazendaController@alterar')->name('altera-fazenda');

Route::get('/fazendeiro','FazendeiroController@index')->name('Fazendeiro')->middleware('auth');
Route::get('/pesquisa-fazendeiro','FazendeiroController@pesquisar')->name('pesquisa-fazendeiro');
Route::match(['get', 'post'],'/inclui-fazendeiro','FazendeiroController@incluir')->name('inclui-fazendeiro');
Route::any('/altera-fazendeiro','FazendeiroController@alterar')->name('altera-fazendeiro');

Route::get('/comprador','CompradorController@index')->name('Fazendeiro')->middleware('auth');
Route::get('/pesquisa-comprador','CompradorController@pesquisar')->name('pesquisa-comprador');
Route::match(['get', 'post'],'/inclui-comprador','CompradorController@incluir')->name('inclui-comprador');
Route::any('/altera-comprador','CompradorController@alterar')->name('altera-comprador');

Route::get('/lote','LoteController@index')->name('Lote')->middleware('auth');
Route::get('/pesquisa-lote','LoteController@pesquisar')->name('pesquisa-lote');
Route::match(['get', 'post'],'/inclui-lote','LoteController@incluir')->name('inclui-lote');
Route::any('/altera-lote','LoteController@alterar')->name('altera-lote');

Route::get('/piquetes','PiquetesController@index')->name('Piquetes')->middleware('auth');
Route::get('/pesquisa-piquetes','PiquetesController@pesquisar')->name('pesquisa-piquetes');
Route::match(['get', 'post'],'/inclui-piquetes','PiquetesController@incluir')->name('inclui-piquetes');
Route::any('/altera-piquetes','PiquetesController@alterar')->name('altera-piquetes');

Route::get('/raca','RacaController@index')->name('Raca')->middleware('auth');
Route::get('/pesquisa-raca','RacaController@pesquisar')->name('pesquisa-raca');
Route::match(['get', 'post'],'/inclui-raca','RacaController@incluir')->name('inclui-raca');
Route::any('/altera-raca','RacaController@alterar')->name('altera-raca');

Route::get('/nascimentos','NascimentosController@index')->name('Nascimentos')->middleware('auth');
Route::get('/pesquisa-nascimentos','NascimentosController@pesquisar')->name('pesquisa-nascimentos');
Route::match(['get', 'post'],'/inclui-nascimentos','NascimentosController@incluir')->name('inclui-nascimentos');
Route::any('/altera-nascimentos','NascimentosController@alterar')->name('altera-nascimentos');

Route::get('/touros','TourosController@index')->name('Touros')->middleware('auth');
Route::get('/pesquisa-touros','TourosController@pesquisar')->name('pesquisa-touros');
Route::match(['get', 'post'],'/inclui-touros','TourosController@incluir')->name('inclui-touros');
Route::any('/altera-touros','TourosController@alterar')->name('altera-touros');

Route::get('/matrizes','MatrizesController@index')->name('Matrizes')->middleware('auth');
Route::get('/pesquisa-matrizes','MatrizesController@pesquisar')->name('pesquisa-matrizes');
Route::match(['get', 'post'],'/inclui-matrizes','MatrizesController@incluir')->name('inclui-matrizes');
Route::any('/altera-matrizes','MatrizesController@alterar')->name('altera-matrizes');

Route::any('/controle-lote','ControleLoteController@index')->name('controle-lote');
Route::any('/controle-altera-lote','ControleLoteController@alterarLotes')->name('altera-lotes');
Route::any('/salva-historico', 'HistoricosController@salvar')->name('salva-historico');

Route::any('/vendas','VendasController@index')->name('vendas');
Route::get('/pesquisa-vendas','VendasController@pesquisar')->name('pesquisa-vendas');
Route::match(['get', 'post'],'/inclui-vendas','VendasController@incluir')->name('inclui-vendas');
Route::any('/altera-vendas','VendasController@alterar')->name('altera-vendas');

Route::any('/relatorio-nascimentos','RelatorioNascimentosController@index')->name('relatorio-nascimentos');
Route::match(['get', 'post'],'/relatorio-nascimentos-gerar','RelatorioNascimentosController@gerarRelatorio')->name('relatorio-nascimentos-gerar');

Route::get('/logout', 'Auth\LogoutController@logout')->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
