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
Route::get('admin/login', 'AdminController@showLogin');
Route::post('admin/login', 'AdminController@adminLogin')->name('adminLogin');
Route::get('admin/register', 'AdminController@showRegister');
Route::post('admin/register', 'AdminController@adminRegister')->name('adminRegister');
Route::get('admin/logout', 'AdminController@Logout');
Route::group(['middleware' => ['admin']], function () {

//Route for showing admin ddashboard
    Route::get('/admin/dashboard', 'AdminController@showDashboard');
//Routes for apartments
    Route::get('/admin/apartments', 'ApartmentsController@showApartmentsTable');
    Route::post('/admin/apartments/add', 'ApartmentsController@addApartment');
    Route::post('/admin/apartments/edit/{id}', 'ApartmentsController@editApartment');
    Route::get('/admin/apartments/photos/delete/{id}', 'ApartmentsController@deleteApartmentEditPhoto');
    Route::post('/admin/apartment/fee/add/{id}', 'ApartmentsController@addFee');
    Route::get('/admin/apartments/delete/{id}', 'ApartmentsController@deleteApartment');
    Route::get('/admin/apartments/view/fees/{id}', 'ApartmentsController@viewFees');
    Route::get('/admin/apartments/delete/fee/{id}', 'ApartmentsController@deleteFee');
    Route::post('/admin/apartment/fee/edit/{id}', 'ApartmentsController@editFee');

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
    Route::post('/admin/reservations/client/image/{id}', 'ReservationsController@saveClientImage');
    Route::post('/admin/reservations/fee/add/{id}', 'ReservationsFeeController@addFee');
    Route::get('/admin/reservations/fee/delete/{id}', 'ReservationsFeeController@deleteFee');
    Route::post('/admin/reservations/fee/edit/{id}', 'ReservationsFeeController@editFee');
    Route::get('/admin/reservations/pdf/fee/{id}', 'ReservationsController@pdfGenerator');
    Route::get('/admin/reservations/secondary_clients/delete/{id}', 'ReservationsController@deleteCloneClient');
    Route::post('admin/reservations/clone/{id}', 'ReservationsController@cloneReservation');
//Route to view fees for reservation editing modal
    Route::get('/admin/reservations/view/fees/{id}', 'ReservationsFeeController@viewFees');
//Route for deleting fee with ajax
    Route::get('/admin/reservations/delete/fee/{id}', 'ReservationsFeeController@deleteFee');

    //Route for adding schedule check in and check out date
    Route::get('/admin/reservations/schedule/add/{id}', 'ReservationsController@AddScheduleDates');


    //Route for adding card data
    Route::get('/admin/reservations/card/add/{id}', 'ReservationsController@AddCardData');

    //Route for searching in reservations Table
    Route::get('/admin/reservations/search', 'ReservationsController@search');

    //Route for caretaker
    Route::post('/admin/reservations/caretaker/{id}', 'ReservationsController@selectCaretaker');
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

    //Route for CRUD admins
    Route::get('/admin/admins', 'AdminCrudController@index');
    Route::post('/admin/admins/add', 'AdminCrudController@add');
    Route::post('/admin/admins/edit/{id}', 'AdminCrudController@edit');
    Route::get('/admin/admins/delete/{id}', 'AdminCrudController@delete');

    //Route for sending email to customer
    Route::get('/admin/mail/caretaker/{id}', 'MailController@sendCaretaker');

    //Route for saving customer signature
    Route::post('/admin/reservations/save/signature/{id}', 'ReservationsController@saveSignature');

    //Route for pdf tenancy
    Route::get('/admin/reservations/pdf/tenancy/{language}/{id}', 'ReservationsController@pdfGeneratorTenancy');

    // Cron Job Route to send email reminder to the main client
    Route::get('/admin/reminder_client/email', 'MailController@sendReminderMail');
    //Route for managing offers
    Route::get('/admin/offers', 'OffersController@index');
    Route::post('/admin/offers/add', 'OffersController@addOffer');
    Route::post('/admin/offers/edit/{id}', 'OffersController@editOffer');
    Route::get('/admin/offers/delete/{id}', 'OffersController@deleteOffer');

    //Routes for simulating payments
    Route::get('/admin/reservations/payment/full/{id}', 'ReservationsController@correctPayment');
    Route::get('/admin/reservations/payment/incorrect/{id}', 'ReservationsController@incorrectPayment');

});
            //Client route for single Blog
        Route::get('/clients/index', 'ClientsController@index');
        Route::get('/clients/blog/{id}', 'ClientsController@viewSinglePost');
        Route::get('/clients/blog', 'ClientsController@allPosts');


        Route::get('/clients/search', 'ClientsController@searchApartments');
        Route::get('/clients/apartment/{id}', 'ClientsController@viewApartment');
        Route::get('/clients/reservation/{id}', 'ClientsController@viewReservation');
        Route::post('/clients/new/reservation', 'ClientsController@newReservation');



