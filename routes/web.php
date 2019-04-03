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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// profile
Route::resource('/profile', 'Profile\ProfileController')->middleware('auth');
Route::get('/profile/tours/add', 'Profile\TourController@create')->middleware('auth')->name('tourAdd');
Route::get('/profile/tours/{id}', 'Profile\TourController@edit')->middleware('auth')->name('tourEdit');




Route::middleware('auth')->prefix('api')->group(function () {
    //Route::resource('/profile', 'Api\ProfileController');
    Route::get('/profile', 'Api\ProfileController@index');
    Route::post('/profile', 'Api\ProfileController@store');
    Route::post('/profile/upload/avatar', 'Api\ProfileController@avatar');
    Route::post('/profile/upload/license', 'Api\ProfileController@uploadLicense');
    Route::post('/profile/upload/license/delete', 'Api\ProfileController@deleteLicense');

    // Tour edit
    Route::get('/profile/tours/{id}', 'Api\TourController@edit');
    Route::post('/profile/tours/{id}', 'Api\TourController@store');
    Route::post('/profile/tours/upload/avatar', 'Api\TourController@avatar');
    Route::post('/profile/tours/upload/license', 'Api\TourController@uploadLicense');
    Route::post('/profile/tours/upload/license/delete', 'Api\TourController@deleteLicense');
    
});
Route::get('/api/geo', 'Api\GeodataController@index');