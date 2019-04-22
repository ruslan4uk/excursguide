<?php

use Illuminate\Http\Request;

// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v2/auth/')->group(function () {
    Route::post('login', 'ApiV2\AuthController@login');
    Route::post('register', 'ApiV2\AuthController@register');
    Route::post('logout', 'ApiV2\AuthController@logout');
    Route::post('refresh', 'ApiV2\AuthController@refresh');
    Route::post('me', 'ApiV2\AuthController@me');
    Route::post('payload', 'ApiV2\AuthController@payload');
});