<?php

Route::group(['prefix' => 'drivers'], function () {
    Route::get('/', 'DriversController@allDrivers');
    Route::get('/add_driver', function () {
        if (Session::get('user')['isAdmin'] != true) {
            return abort(404);
        } else {
            return view('drivers.add_driver');
        }
    });
    Route::post('/insert_driver', 'DriversController@insertDriver');
    Route::get('datatable', 'DriversController@datatable')->name('drivers_datatable');

    Route::get('get-drivers-to-map', 'DriversController@getDriversToMap');
    Route::get('{id}/edit', 'DriversController@editDriver');
    Route::post('update_driver', 'DriversController@updateDriver');
    Route::delete('delete', 'DriversController@deleteDriver');
    Route::get('{id}/change_block_status', 'DriversController@updateDriverBlockStatus');
    Route::get('{id}/profile', 'DriversController@getDriverProfile');
});


Route::group(['prefix' => 'clients'], function () {
    Route::get('/', 'ClientsController@allClients');

    Route::get('/add_client', function () {
        return view('clients.add_client');
    });
    Route::post('/insert_client', 'ClientsController@insertClient');

    Route::get('datatable', 'ClientsController@datatable')->name('clients_datatable');
    Route::get('create_request', 'ClientsController@getCreateRequest');

    Route::get('{id}/edit', 'ClientsController@editClient');
    Route::post('update_client', 'ClientsController@updateClient');
    Route::delete('delete', 'ClientsController@deleteClient');
    Route::get('{id}/change_block_status', 'ClientsController@updateClientBlockStatus');

    Route::get('history', function () {
        return view('clients.history');
    });
    // Route::get('datatable', 'ClientsController@clientRequestsDatatable')->name('client_requests_datatable');

});

Route::group(['prefix' => 'requests'], function () {
    Route::get('/active/customers', 'RequestsController@allRequests');
    Route::get('/history/{any?}', 'RequestsController@allRequests');

    Route::get('datatable', 'RequestsController@datatable')->name('requests_datatable');
    Route::get('get_map', 'ClientsController@map');

    Route::post('create_request', 'RequestsController@createRequest');

});


Route::group(['prefix' => 'feedbacks'], function () {
    Route::get('/customers', 'FeedbacksController@allFeedbacks');
    Route::get('/drivers', 'FeedbacksController@allFeedbacks');
    Route::get('datatable/{type}', 'FeedbacksController@datatable');

});

Route::get('advanced', function () {
    return view('advanced');
});

Route::get('/logout', function() {
    if (Session::has('user')) {
        Session::forget('user');
    }
    return redirect('/login');
});
Route::get('/404', function () {
    return view('404');
});

Route::get('/filter/{id}', 'ClientsController@filterMap');
Route::post('auth', 'Auth\LoginController@auth');
Route::post('sign-in', 'DriversController@signIn');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
