<?php

Route::group(['prefix'=>'drivers'], function(){
	Route::get('/', 'DriversController@allDrivers');
	Route::get('/add_driver', function () {
	    return view('drivers.add_driver');
	});
	Route::post('/insert_driver', 'DriversController@insertDriver');
	Route::get('datatable', 'DriversController@datatable')->name('drivers_datatable');

	Route::get('get-drivers-to-map', 'DriversController@getDriversToMap');
});



Route::group(['prefix'=>'clients'], function(){
	Route::get('/', 'ClientsController@allClients');

	Route::get('/add_client', function () {
	    return view('clients.add_client');
	});
	Route::post('/insert_client', 'ClientsController@insertClient');

	Route::get('datatable', 'ClientsController@datatable')->name('clients_datatable');
	Route::get('make_request', function(){
		return view('clients.make_request');
	});

	Route::get('history', function(){
		return view('clients.history');
	});
	Route::get('datatable', 'ClientsController@clientRequestsDatatable')->name('client_requests_datatable');

});

Route::group(['prefix'=>'requests'], function(){
	Route::get('/active/customers', 'RequestsController@allRequests');
	Route::get('/history/{any?}', 'RequestsController@allRequests');

	Route::get('datatable', 'RequestsController@datatable')->name('requests_datatable');
	Route::get('get_map', function(){
		return view('maps.make_request');
	});
});

Route::get('test-map', function(){
	return view('test-map');
});

Route::get('auth', 'AuthController@auth');
Route::post('sign-in', 'DriversController@signIn');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
