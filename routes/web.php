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

Route::get('/', 'WidgetController@index')->name('welcome');
Route::post('/create', 'WidgetController@store')->name('create');
Route::post('/request/{function_name}', 'WidgetController@reply')->name('request');

Auth::routes();

Route::get('/home', 'HomeController@index');
