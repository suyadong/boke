<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//登录路由
Route::get('/admin/login', 'Admin\LoginController@index');
//登录处理路由
Route::post('/admin/dologin', 'Admin\LoginController@dologin');
//验证码路由
Route::get('/admin/code', 'Admin\LoginController@code');
Route::get('/crypt', 'Admin\LoginController@crypt');

//后台首页路由
Route::get('admin','Admin\IndexController@index');
Route::get('admin/info','Admin\IndexController@info');
//修改密码路由
Route::get('admin/pass','Admin\IndexController@pass');
Route::post('admin/dopass','Admin\IndexController@dopass');

//用户模块
Route::resource('admin/user','Admin\UserController');

//分类模块
Route::resource('admin/cate','Admin\CateController');



//第三方验证码路由
//Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');