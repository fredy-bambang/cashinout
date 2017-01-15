<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware'=> 'web'],function(){
  Route::group(['middleware' => ['role:admin,all']], function () {
  });
  
});
//dailytransaction Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('dailytransaction','\App\Http\Controllers\DailytransactionController');
  Route::post('dailytransaction/{id}/update','\App\Http\Controllers\DailytransactionController@update');
  Route::get('dailytransaction/{id}/delete','\App\Http\Controllers\DailytransactionController@destroy');
  Route::get('dailytransaction/{id}/deleteMsg','\App\Http\Controllers\DailytransactionController@DeleteMsg');
});
