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
    echo "api";die;
//    return view('welcome');
});
Route::get('/shop2/info','Api\TestController@info');

Route::any('/test/decrypt1','Api\TestController@decrypt1');
