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
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('/register', 'Auth\RegisterController@index')->name('register.index');
        Route::post('/register', 'Auth\RegisterController@store')->name('register.store');
        Route::get('/resetPassword', 'Auth\ResetPasswordController@index')->name('resetPassword.index');
        Route::patch('/resetPassword', 'Auth\ResetPasswordController@update')->name('resetPassword.update');
    });
});

Route::group(['prefix' => '/manager', 'namespace' => 'Manager', 'as' => 'manager.'], function () {
    Auth::routes(['register' => false, 'verify' => false, 'reset' => false]);
    Route::middleware(['auth:manager'])->group(function () {
        Route::get('/', 'ManagerController@index')->name('index');
        Route::get('/resetPassword', 'Auth\ResetPasswordController@index')->name('resetPassword.index');
        Route::patch('/resetPassword', 'Auth\ResetPasswordController@update')->name('resetPassword.update');
    });
});

Route::group(['prefix' => '/event', 'as' => 'event.'], function () {
    Route::middleware('auth:manager,admin')->group(function () {
        Route::get('/create', 'EventController@create')->name('create');
        Route::post('/', 'EventController@store')->name('store');
        Route::get('/{event}/edit', 'EventController@edit')->name('edit')->middleware('event.permission');
        Route::patch('/{event}', 'EventController@update')->name('update')->middleware('event.permission');
        Route::delete('/{event}', 'EventController@destroy')->name('destroy')->middleware('event.permission');
        Route::get('/{event}/export', 'EventController@export')->name('export')->middleware('event.permission');
    });
});

Route::name('event.')->group(function () {
    Route::get('/', 'EventController@index')->name('index');
    Route::get('/{param}', 'EventController@index')->name('index.param');
    Route::get('/events/{event}', 'EventController@show')->name('show');
});
