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
    return view('welcome');
});

//Routes for admin login and register
Route::get('/login', 'AdminController@showLogin');
Route::post('/login', 'AdminController@adminLogin')->name('adminLogin');
Route::get('/register', 'AdminController@showRegister');
Route::post('/register', 'AdminController@adminRegister')->name('adminRegister');
