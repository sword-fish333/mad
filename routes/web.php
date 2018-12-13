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
Route::post('/admin/apartments/edit/{id}', 'ApartmentsController@editApartment');
Route::get('/admin/apartments/photos/delete/{id}', 'ApartmentsController@deleteApartmentEditPhoto');

Route::get('/admin/apartments/delete/{id}', 'ApartmentsController@deleteApartment');


//Routes for CRUD on features of the Apartment
Route::get('/admin/features', 'FeaturesController@showFeatures');
Route::post('/admin/features/add', 'FeaturesController@addFeature');
Route::post('/admin/features/edit/{id}', 'FeaturesController@editFeature');
Route::get('/admin/features/delete/{id}', 'FeaturesController@deleteFeature');

//ReservationsController@changeClientImage'
//Routes for CRUD on reservations
Route::get('/admin/reservations', 'ReservationsController@showReservations');
Route::post('/admin/reservations/add', 'ReservationsController@addReservation');
Route::post('admin/reservations/edit/{id}', 'ReservationsController@editReservations');
Route::get('/admin/reservations/delete/{id}', 'ReservationsController@deleteReservations');
Route::get('/admin/reservations/status/{id}', 'ReservationsController@changeStatus');
//Route::post('/admin/reservations/client/image', 'ReservationsController@saveClientImage');
Route::post('/admin/reservations/client/image/{id}','ReservationsController@saveClientImage');


