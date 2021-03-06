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

Route::group(['prefix' => '/', 'user.', 'namespace' => 'User'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Auth::routes();

    Route::get('/group', 'GroupController@index')->name('group.index');
    Route::get('/group/{id}/chat', 'GroupController@show')->name('group.show');
    Route::get('/group/create', 'GroupController@create')->name('group.create');
    Route::post('/group/store', 'GroupController@store')->name('group.store');
});

Route::group(['prefix' => '/', 'user.', 'namespace' => 'Api'], function () {
    Route::get('/group/{id}/chat/store', 'ChatController@show');
    Route::post('/group/{id}/chat/store', 'ChatController@store')->name('api.store');
    Route::get('/group/{id}/chat/show', 'ChatController@show');
    Route::get('/user/id', 'ChatController@getUserId');
    Route::get('/users', 'ChatController@getSearchUsers');
});
