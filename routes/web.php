<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'App\Http\Controllers\IndexController@index');
Route::post('/', 'App\Http\Controllers\IndexController@index');
Route::post('/send0', 'App\Http\Controllers\SendController@SendDeath');
Route::post('/send1', 'App\Http\Controllers\SendController@SendResult');