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


// USER //

Route::prefix('user')->group(function(){
    Route::get('signin', 'PagesController@Signin'); // signin page
    Route::post('signin', 'PagesController@SigninRequest'); // signin submit form
    Route::get('signout', 'PagesController@Signout'); // signout
});


// CRM //

Route::middleware(['crm.guard'])->group(function () { // guard from unauthorized users

    Route::get('/', 'PagesController@Dashboard'); // dashboard page
    Route::resource('customers', 'CustomersController'); // customers resource
    Route::resource('tickets', 'TicketsController'); // tickets resource
    Route::resource('handles', 'HandlesController'); // handles resource

    Route::get('ticket/{id}/changeStatus', 'TicketsController@changeStatus'); // change ticket status

    Route::post('search_customers', 'CustomersController@searchCustomers'); // search customers

});




// ADMIN

Route::middleware(['admin.panel.guard'])->group(function () { // allows admin only

    Route::prefix('admin')->group(function(){ // prefix admin url
        Route::resource('users', 'UsersController'); // users resource

        Route::get('users/{id}/changeStatus', 'UsersController@changeStatus'); // change ticket status
    });

});
