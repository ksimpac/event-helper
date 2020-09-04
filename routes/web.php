<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => false]);

//Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::middleware(['auth', 'user'])->group(function() {
    Route::get('/users/{user}/edit', 'UserController@edit');
    Route::get('/users/{user}', 'UserController@show');
    Route::patch('/users/{user}','UserController@update');
    Route::post('/events/{event}/{user}/signup','EventController@signup');
    Route::post('/events/{event}/{user}/favorite','EventController@favorite');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/events/create', 'EventController@create');
    Route::post('/events', 'EventController@store');
    Route::get('/events/{event}/edit', 'EventController@edit');
    Route::patch('/events/{event}', 'EventController@update');
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/register' , 'AdminController@register');
    Route::post('/admin/register', 'AdminController@store');
    Route::delete('/events/{event}', 'EventController@destroy');
    Route::get('/events/{event}/export', 'AdminController@export');
});

Route::middleware('auth')->group(function(){
    Route::get('/changePassword', 'ChangePasswordController@index');
    Route::post('/changePassword', 'ChangePasswordController@update');
});

Route::get('/', 'EventController@index');
Route::get('/{param}', 'EventController@index');
Route::get('/events/{event}', 'EventController@show');