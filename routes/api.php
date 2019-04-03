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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'as' => 'api.',
    'namespace' => 'Api'
], function () {

    Route::group([
        'prefix' => 'users',
        'as' => 'users.'
    ], function () {
        Route::get('', 'UserController@index')->name('index');
        Route::post('', 'UserController@store')->name('store');
        Route::get('{user}/show', 'UserController@show')->name('show');
        Route::put('{user}/update', 'UserController@update')->name('update');
        Route::delete('{user}/destroy', 'UserController@destroy')->name('destroy');
    });

});
