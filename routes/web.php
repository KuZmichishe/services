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

// 'home'
// 'home/1'
// 'home/1/edit'
// 'home/1' PUT
// 'home' POST

Route::resource('home', 'HomeController');

Route::get('/', function () {
    return view('welcome');
});
