<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('index', 'ApiRouteController@index');

Route::group(['prefix'=>'data'], function () {
    Route::get('kabkot', 'ApiRouteController@dataKabkot');
    Route::get('kecamatan/{name}', 'ApiRouteController@dataKecamatan');
    Route::get('kelurahan/{name}', 'ApiRouteController@dataKelurahan');
    Route::get('statuskedudukan', 'ApiRouteController@dataStatusKedudukan');
    Route::get('jenislaporan', 'ApiRouteController@dataJenisLaporan');
    Route::get('kategori', 'ApiRouteController@dataKategori');
    Route::get('jenis', 'ApiRouteController@dataJenis');
});

Route::group(['prefix'=>'action'], function () {
    Route::post('insert', 'ApiRouteController@actionInsert');
});