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
//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/', 'AuthController@login');

Route::group(['middleware'=>['web']],function(){
	Route::get('/login',['as'=>'login', 'uses' => 'AuthController@login']);
	Route::post('/handleLogin',['as'=>'handleLogin', 'uses' => 'AuthController@handleLogin']);
	Route::get('/home',['middleware'=>'auth', 'as'=>'home', 'uses'=> 'UsersController@home']);
	Route::get('/logout',['as'=>'logout','uses'=>'AuthController@logout']);
	Route::resource('users','UsersController',['only' => ['create','store']]);
});

Route::get('down',function(){
    Artisan::call('down');
    return view('welcome');
});

Route::get('/entry','DataController@entry');
Route::get('/masuk','DataController@pemasukan');
Route::get('/keluar','DataController@pengeluaran');
Route::get('database','SapaController@index');
Route::post('sapa/insert','SapaController@insert');
Route::get('sapa/delete/{id}', 'SapaController@delete');
