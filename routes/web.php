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

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
Route::get('/add-flow', ['as' => 'add-flow', 'uses' => 'HomeController@createFlow']);
Route::post('/store-flow', ['as' => 'store-flow', 'uses' => 'HomeController@storeFlow']);
Route::delete('/destroy-flow', ['as' => 'destroy-flow', 'uses' => 'HomeController@destroyFlow']);