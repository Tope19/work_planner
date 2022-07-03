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
        Route::get('/', 'TimetableController@index');
        Route::get('/{id}', 'TimetableController@show');
        Route::post('/', 'TimetableController@store');
    });

    Route::prefix('shifts')->group(function () {
        Route::get('/', 'ShiftController@index');
        Route::get('/{id}', 'ShiftController@show');
        Route::post('/', 'ShiftController@store');
    });


});
