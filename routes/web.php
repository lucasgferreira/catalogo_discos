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

Route::resource('/disco/discos', 'Disco\DiscoController');
Route::resource('/artista/artistas', 'Artista\ArtistaController');
Route::resource('/categoria/categorias', 'Categoria\CategoriaController');


Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function (){

    Route::get('home', 'AdminController@index')->name('admin.home');
    Route::get('login', 'AdminController@login')->name('admin.login');
    Route::get('user', 'AdminController@user')->name('admin.user');
});

Route::group(['middleware' => ['auth'], 'namespace' => 'Disco', 'prefix' => 'disco'], function (){

    Route::get('discos', 'DiscoController@index')->name('disco.discos');
});

Route::group(['middleware' => ['admin'], 'namespace' => 'Disco', 'prefix' => 'disco'], function (){

    Route::get('cadastrar_discos', 'DiscoController@create')->name('disco.create');
    Route::get('editar_discos/{id}', 'DiscoController@edit')->name('disco.edit');
    Route::get('excluir_discos/{id}', 'DiscoController@destroy')->name('disco.destroy');
});

Route::group(['middleware' => ['admin'], 'namespace' => 'Artista', 'prefix' => 'artista'], function (){

    Route::get('cadastrar_artista', 'ArtistaController@create')->name('artista.create');
    Route::get('editar_artista/{id}', 'ArtistaController@edit')->name('artista.edit');
    Route::get('excluir_artista/{id}', 'ArtistaController@destroy')->name('artista.destroy');
    Route::get('artistas', 'ArtistaController@index')->name('artista.artistas');
});

Route::group(['middleware' => ['admin'], 'namespace' => 'Categoria', 'prefix' => 'categoria'], function (){

    Route::get('cadastrar_categoria', 'CategoriaController@create')->name('categoria.create');
    Route::get('editar_categoria/{id}', 'CategoriaController@edit')->name('categoria.edit');
    Route::get('excluir_categoria/{id}', 'CategoriaController@destroy')->name('categoria.destroy');
    Route::get('categorias', 'CategoriaController@index')->name('categoria.categorias');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

