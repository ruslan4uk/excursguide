<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Auth routes
 * url: /auth/{page}
 */
Route::prefix('v2/auth/')->group(function () {
    Route::post('login', 'ApiV2\AuthController@login');
    Route::post('register', 'ApiV2\AuthController@register');
    Route::post('logout', 'ApiV2\AuthController@logout');
    Route::post('refresh', 'ApiV2\AuthController@refresh');
    Route::post('me', 'ApiV2\AuthController@me');
    Route::post('payload', 'ApiV2\AuthController@payload');
});

Route::prefix('v2/')->middleware('role:admin')->group(function () {    
    
    Route::prefix('dashboard/')->group(function () {
        Route::get('index', 'ApiV2\Dashboard\HomeController@index');
    });
    
    /**
     * Settings routes
     * url: /settings/{page}
     */
    Route::prefix('settings/')->group(function () {
        Route::resource('languages', 'ApiV2\Languages\HomeController')->only(['index', 'store', 'destroy']);

        Route::resource('services', 'ApiV2\Services\HomeController')->only(['index', 'store', 'destroy']);

        Route::resource('categories', 'ApiV2\Categories\HomeController')->only(['index', 'store', 'destroy']);
    });

    /**
     * Articles
     */
    Route::post('articles/upload', 'ApiV2\Articles\UploadController@upload');
    Route::resource('articles', 'ApiV2\Articles\HomeController')->only(['index', 'store', 'destroy']);


    /**
     * Search
     */
    Route::prefix('search/')->group(function () {
        Route::get('get-country', 'ApiV2\Search\GeoController@getCountry');
        Route::get('get-city', 'ApiV2\Search\GeoController@getCity');
    });
});

