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
    return view('welcome');
});

Auth::routes();
Route::get('users','usersController@index');

Route::get('/admin','adminController@index');

Route::get('/home', 'HomeController@index');
Route::get('e-ktp','ktpController@index');
Route::get('e-ktp/new',function(){
   return view('ktp.create');
});


Route::post('admin/login','adminController@login');
Route::post('e-ktp','ktpController@store');
Route::get('e-ktp/update','ktpController@update');

Route::post('e-kk','kkController@store');
Route::get('e-kk','kkController@index');
Route::get('e-kk/mutasi','kkController@mutasi');
Route::get('e-kk/new','kkController@create');
Route::get('e-kk/update','kkController@update');
Route::get('e-kk/{no_kk}/','kkController@getanggota');
Route::POST('e-kk/detail','kkController@postupdate');
Route::get('e-kk/{id}/detail','kkController@view');

Route::get('e-aktalahir','aktaController@index');
Route::get('e-aktalahir/new','aktaController@create');
Route::post('e-aktalahir','aktaController@store');
Route::POST('e-aktalahir/validate/{id}','aktaController@validate_akta');
Route::get('e-aktalahir/{id}/view','aktaController@view');
Route::get('e-aktalahir/{id}/edit','aktaController@edit');
Route::get('e-aktalahir/update','aktaController@update');
Route::get('e-aktalahir/cari/{nik}','aktaController@cari');
Route::post('e-aktalahir/{id}/update','aktaController@postupdate');
Route::get('e-aktalahir/status={data}','aktaController@filter');
Route::get('e-aktalahir/{id}/revisi','aktaController@getRevisi');
Route::post('e-aktalahir/{id}/revisi','aktaController@Revisi');

Route::get('e-aktanikah','aktanikahController@index');
Route::get('e-aktanikah/new','aktanikahController@create');
Route::post('e-aktanikah','aktanikahController@store');
Route::get('e-aktanikah/{id}/edit','aktanikahController@edit');