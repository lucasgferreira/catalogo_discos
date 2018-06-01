
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

Route::resource('/admin/discos', 'Admin\DiscosController');



Route::group(['midleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function (){

    Route::get('home', 'AdminController@index')->name('admin.home');
    Route::get('login', 'AdminController@login')->name('admin.login');
    Route::get('user', 'AdminController@user')->name('admin.user');
    Route::get('cadastrar_discos', 'DiscosController@create')->name('admin.create');
    Route::get('editar_discos/{id}', 'DiscosController@edit')->name('admin.edit');
    Route::get('excluir_discos/{id}', 'DiscosController@edit')->name('admin.destroy');
    Route::get('discos', 'DiscosController@index')->name('admin.discos');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

