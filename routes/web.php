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


Route::get('/', function () {
    return redirect('auth');
});
Route::any('paraVotar/grafico/{id}', 'ParaVotarController@grafico');
Route::get('paraVotar/show/{id}','ParaVotarController@votar');
Route::get('pdf', 'GraficoVotosController@pdf')
    ->name('pdf.vista');
Route::any('graficos/index2/{id}','GraficoVotosController@index2');
Route::post('segundoLogin', 'Auth\LoginController@segundoLogin');
Route::resource('paraVotar', 'ParaVotarController');
Route::post('login', 'Auth\LoginController@redireccionar');
Route::any('cerrarsesion', 'Auth\LoginController@cerrarsesion');
Route::resource('votacion', 'VotacionController');
Route::resource('graficos', 'GraficoVotosController');
Route::resource('candidato', 'CandidatoController');
Route::resource('tipo-votacion', 'TipoVotacionController');
Route::resource('auth', 'Auth\LoginController');
Route::any('tipoVotacion', 'TipoVotacionController@show');
Route::get('proximas', 'ParaVotarController@buscar_proximas')
    ->name('paraVotar.proximas');
Route::get('realizadas', 'ParaVotarController@buscar_participadas')
    ->name('paraVotar.realizadas');
Route::get('encurso', 'VotacionController@encurso')
    ->name('votacion.encurso');
    
Route::get('/test/datepicker', function () {
    return view('datepicker');


});

Route::post('/test/save', ['as' => 'save-date',
                           'uses' => 'DateController@showDate', 
                            function () {
                                return '';
                            }]);