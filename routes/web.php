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
    return view('index');
});

Route::resource('Task','TaskController',['except'=>['create','show','edit'] ]);

Route::resource('SubTask','SubtaskController',['except'=>['create','show','edit'] ]);