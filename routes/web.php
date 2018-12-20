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
Route::post('/admin/apartment/fee/add/{id}', 'ApartmentsController@addFee');
Route::get('/admin/apartments/delete/{id}', 'ApartmentsController@deleteApartment');
Route::get('/admin/apartments/view/fees/{id}', 'ApartmentsController@viewFees');
Route::get('/admin/apartments/delete/fee/{id}', 'ApartmentsController@deleteFee');
//Route for adding price for a given period of time for a apartment
Route::post('/admin/apartment/cost/add/{id}', 'ApartmentCostController@addCost');
Route::get('/admin/apartments/view/costs/{id}', 'ApartmentCostController@viewCosts');
Route::get('/admin/apartments/delete/cost/{id}', 'ApartmentCostController@deletePrice');
Route::post('/admin/apartment/cost/edit/{id}', 'ApartmentCostController@editCost');

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
Route::get('/admin/reservations/delete/{id}', 'ReservationsController@deleteReservation');
Route::get('/admin/reservations/status/{id}', 'ReservationsController@changeStatus');
//Route::post('/admin/reservations/client/image', 'ReservationsController@saveClientImage');
Route::post('/admin/reservations/client/image/{id}','ReservationsController@saveClientImage');
Route::post('/admin/reservations/fee/add/{id}', 'ReservationsFeeController@addFee');
Route::get('/admin/reservations/fee/delete/{id}', 'ReservationsFeeController@deleteFee');
Route::post('/admin/reservations/fee/edit/{id}', 'ReservationsFeeController@editFee');

//Routes Apartment Holders
Route::get('/admin/holders', 'ApartmentHolderController@showHolders');
Route::post('/admin/holders/add', 'ApartmentHolderController@addHolder');
Route::get('/admin/holders/delete/{id}', 'ApartmentHolderController@deleteHolder');

//Routes for MadreamRent Pages
Route::get('/admin/pages', 'StaticPagesController@index');
Route::post('/admin/pages/add', 'StaticPagesController@addPage');
Route::post('/admin/pages/edit/{id}', 'StaticPagesController@editPage');
Route::get('/admin/pages/delete/{id}', 'StaticPagesController@deletePage');

//Routes for calendar
Route::get('/admin/calendar', 'CalendarController@index');



