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
    return view('locations.index');
});
Route::get('devices/edit/{device}','DeviceController@edit')->name('devices.edit');
Route::get('locations/index', 'LocationController@index')->name('locations.index');
Route::get('devices/create', 'DeviceController@create')->name('device.create');
Route::post('devices', 'DeviceController@store')->name('device.store');
Route::patch('devices/update/{device}','DeviceController@update')->name('device.update');
Route::delete('devices/delete/{device}','DeviceController@destroy')->name('device.destroy');
//delete location
Route::delete('locations/delete/{location}','LocationController@destroy')->name('locations.destroy');
Route::post('locations', 'LocationController@store')->name('location.store');
Route::get('locations/create', 'LocationController@create')->name('location.create');
Route::patch('locations/update/{location}','LocationController@update')->name('location.update');
Route::get('locations/edit/{location}','LocationController@edit')->name('locations.edit');
