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
    return view('home');
});

Route::get('/upload',function(){
    return view('upload');
});

Route::get('/recognizer',function(){
    return view('recognizer');
});

Route::post('/uploadModel','ModelController@uploadModel');

Route::post('/recognizeSingle','ModelController@recognizeSingle');
Route::post('/saveModelDescriptor','ModelController@saveDescriptor');
Route::get('/getDescriptor','ModelController@getDescriptor');