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
//Route for showing admin ddashboard
Route::get('/admin/dashboard', 'AdminController@showDashboard');
//Routes for admin login and register
Route::get('admin/login', 'AdminController@showLogin');
Route::post('admin/login', 'AdminController@adminLogin')->name('adminLogin');
Route::get('admin/register', 'AdminController@showRegister');
Route::post('admin/register', 'AdminController@adminRegister')->name('adminRegister');
Route::get('admin/logout', 'AdminController@Logout');

//Routes for apartments
Route::get('/admin/apartments', 'ApartmentsController@showApartmentsTable');
Route::post('/admin/apartments/add', 'ApartmentsController@addApartment');
