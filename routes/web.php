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

Auth::routes(['register' => true]);

Route::get('lang/{locale}', 'HomeController@lang');

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'users',
    'as' => 'users.'
], function () {
    Route::get('data-table', 'UserController@getUsersForDataTable')->name('table');
    Route::get('translate-table', 'UserController@getTableTranslateArray')->name('table.translate');
    Route::get('', 'UserController@index')->name('index');
    Route::get('create', 'UserController@create')->name('create');
    Route::post('', 'UserController@store')->name('store');
    Route::get('{user}/show', 'UserController@show')->name('show');
    Route::get('{user}/edit', 'UserController@edit')->name('edit');
    Route::put('{user}/update', 'UserController@update')->name('update');
    Route::delete('{user}/destroy', 'UserController@destroy')->name('destroy');
});
