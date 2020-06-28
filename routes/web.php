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

Route::get('/test/hello','TestController@hello');
Route::get('/test/redis1','TestController@redis1');
//测试
Route::get('/test1','TestController@test1');

//商品
Route::get('/goods/detail','Goods\GoodsController@detail');//商品详情
Route::get('/goods/denglu','Goods\GoodsController@denglu');//商品详情


Route::get('/user/reg','User\IndexController@reg');
Route::post('/user/regDo','User\IndexController@regDo');
Route::get('/user/login','User\IndexController@login');
Route::post('/user/loginDo','User\IndexController@loginDo');
Route::get('/user/center','User\IndexController@center');  //用户中心

//APi
Route::post('/api/user/reg','Api\UserController@reg');//注册接口
Route::post('/api/user/login','Api\UserController@login');//登录接口
Route::get('/api/user/center','Api\UserController@center');//个人接口


