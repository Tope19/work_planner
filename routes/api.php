<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('workers')->group(function () {
        Route::get('/', 'WorkerController@index');
        Route::get('/{id}', 'WorkerController@show');
        Route::post('/', 'WorkerController@store');
    });

    Route::prefix('timetables')->group(function () {
        Route::get('/', 'TimestableController@index');
        Route::get('/{id}', 'TimestableController@show');
        Route::post('/', 'TimestableController@store');
    });


});
