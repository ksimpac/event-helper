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

Route::middleware(['auth', 'user'])->group(function () {
    Route::name('user.')->group(function () {
        Route::get('/users/{STU_ID}', 'UserController@show')->name('show');
        Route::patch('/users/{STU_ID}', 'UserController@update')->name('update');
        Route::post('/events/{event}/{STU_ID}/signup', 'EventController@signup')->name('signup');
        Route::post('/events/{event}/{STU_ID}/favorite', 'EventController@favorite')->name('favorite');
    });
});

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Auth::routes(['register' => false, 'verify' => false, 'reset' => false]);
    Route::middleware(['auth:admin', 'admin'])->group(function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('/register', 'AdminController@register')->name('register');
        Route::post('/register', 'AdminController@store')->name('store');
        Route::get('/resetPassword', 'Auth\ResetPasswordController@index')->name('resetPassword.index');
        Route::patch('/resetPassword', 'Auth\ResetPasswordController@update')->name('resetPassword.update');
    });
});

Route::group(['prefix' => '/manager', 'namespace' => 'Manager', 'as' => 'manager.'], function () {
    Auth::routes(['register' => false, 'verify' => false, 'reset' => false]);
    Route::middleware(['auth:manager', 'manager'])->group(function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('/resetPassword', 'Auth\ResetPasswordController@index')->name('resetPassword.index');
        Route::patch('/resetPassword', 'Auth\ResetPasswordController@update')->name('resetPassword.update');
    });
});

Route::group(['prefix' => '/event', 'as' => 'event.'], function () {
    Route::middleware('auth:manager,admin')->group(function () {
        Route::get('/create', 'EventController@create')->name('create');
        Route::post('/', 'EventController@store')->name('store');
        Route::get('/{event}/edit', 'EventController@edit')->name('edit');
        Route::patch('/{event}', 'EventController@update')->name('update');
        Route::delete('/{event}', 'EventController@destroy')->name('destroy');
        Route::get('/{event}/export', 'AdminController@export')->name('export');
    });
});

Route::name('event.')->group(function () {
    Route::get('/', 'EventController@index')->name('index');
    Route::get('/{param}', 'EventController@index')->name('index.param');
    Route::get('/events/{event}', 'EventController@show')->name('show');
});
