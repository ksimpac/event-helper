<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['register' => false, 'verify' => false, 'reset' => false]);

//Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::middleware(['auth', 'user'])->group(function () {
    Route::name('user.')->group(function () {
        Route::get('/users/{user}/edit', 'UserController@edit')->name('edit');
        Route::get('/users/{user}', 'UserController@show')->name('show');
        Route::patch('/users/{user}', 'UserController@update')->name('update');
        Route::post('/events/{event}/{user}/signup', 'EventController@signup')->name('signup');
        Route::post('/events/{event}/{user}/favorite', 'EventController@favorite')->name('favorite');
    });
});

Route::middleware(['auth', 'manager'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('/admin', 'AdminController@index')->name('index');
        Route::get('/admin/register', 'AdminController@register')->name('register');
        Route::post('/admin/register', 'AdminController@store')->name('store');
        Route::get('/admin/resetPassword', 'changePasswordController@index')->name('resetPassword.index');
        Route::patch('/admin/resetPassword', 'changePasswordController@update')->name('resetPassword.update');

    });

    Route::name('event.')->group(function () {
        Route::get('/events/create', 'EventController@create')->name('create');
        Route::post('/events', 'EventController@store')->name('store');
        Route::get('/events/{event}/edit', 'EventController@edit')->name('edit');
        Route::patch('/events/{event}', 'EventController@update')->name('update');
        Route::delete('/events/{event}', 'EventController@destroy')->name('destroy');
        Route::get('/events/{event}/export', 'AdminController@export')->name('export');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('/admin/forgotAccount', 'Auth\ForgotAccountController@index')->name('forgotPassword.index');
        Route::post('/admin/forgotAccount', 'Auth\ForgotAccountController@getInfo')->name('forgotPassword.getInfo');
    });
});

Route::middleware('auth')->group(function () {
    Route::name('auth.')->group(function () {
        Route::get('/changePassword', 'changePasswordController@index')->name('index');
        Route::patch('/changePassword', 'changePasswordController@update')->name('update');
    });
});

Route::name('event.')->group(function () {
    Route::get('/', 'EventController@index')->name('index');
    Route::get('/{param}', 'EventController@index')->name('index.param');
    Route::get('/events/{event}', 'EventController@show')->name('show');
});
