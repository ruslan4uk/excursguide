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
    return view('main');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Pages
Route::get('/about', function() {
    return view('frontend.pages.about');
})->name('about');


// profile
Route::resource('/profile', 'Profile\ProfileController')->middleware('auth');

Route::get('/profile/tours/index', 'Profile\TourController@index')->middleware('auth')->name('tourList');
Route::get('/profile/tours/index/moderate', 'Profile\TourController@moderate')->middleware('auth')->name('tourListModerate');
//Route::get('/profile/tours/index/archive', 'Profile\TourController@archive')->middleware('auth')->name('tourListArchive');
Route::get('/profile/tours/add', 'Profile\TourController@create')->middleware('auth')->name('tourAdd');
Route::get('/profile/tours/{id}/edit', 'Profile\TourController@edit')->middleware('auth')->name('tourEdit');



// Api
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
    Route::post('/profile/tours/upload/photo', 'Api\TourController@uploadLicense');
    Route::post('/profile/tours/upload/photo/delete', 'Api\TourController@deleteLicense');

    // Category
    Route::get('/category/list', 'Api\CategoryController@index');
    // Service
    Route::get('/service/list', 'Api\ServiceController@index');
    
});

// Geodata
Route::get('/api/geo', 'Api\GeodataController@index');
Route::get('/s', 'Api\GeodataController@search')->name('mainSearch');

// Frontend
// Catalog
Route::get('/city/{id}/tours', 'Frontend\CatalogController@tours')->name('catalogTours');
Route::get('/city/{id}/guides', 'Frontend\CatalogController@guides')->name('catalogGuides');
Route::get('/city/{id}/tours/category-{category}', 'Frontend\CatalogController@category')->name('catalogCategory');

// Pages
Route::get('/tour/{id}', 'Frontend\TourController@index')->name('tourIndex');

Route::get('/guide/{id}', 'Frontend\GuideController@index')->name('guideIndex');
// Add comment
Route::post('/guide/{id}', 'Frontend\GuideController@addComment')->middleware('auth')->name('addComment');



/**
 * Admin routes
 */
Route::get('/eg-admin', function(){
    return 'Is admin panel';
})->middleware('auth', 'role:admin');