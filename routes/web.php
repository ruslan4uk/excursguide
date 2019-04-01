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

// ->names([
//     'index' => 'profile',
//     'store' => 'profile.update',
// ]);

Route::middleware('auth')->prefix('api')->group(function () {
    //Route::resource('/profile', 'Api\ProfileController');
    Route::get('/profile', 'Api\ProfileController@index');
    Route::post('/profile', 'Api\ProfileController@store');
    Route::post('/profile/upload/avatar', 'Api\ProfileController@avatar');
    Route::post('/profile/upload/license', 'Api\ProfileController@uploadLicense');
    Route::post('/profile/upload/license/delete', 'Api\ProfileController@deleteLicense');
});
Route::get('/api/geo', 'Api\GeodataController@index');