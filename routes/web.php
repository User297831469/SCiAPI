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

//home

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

//widgets

Route::post('/create', 'WidgetController@store')->name('create');
Route::post('/update/{id}', 'WidgetController@update')->name('update');

//API

Route::post('/request/{function_name}', 'WidgetController@reply')->name('request')->middleware('cors');

//auth

Auth::routes();
