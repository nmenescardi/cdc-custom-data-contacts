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

Route::get('/', 'Auth\LoginController@login');

Route::resource('contacts', 'ContactController');

Route::resource('records', 'RecordController');

Route::resource('tags', 'TagController');

Route::resource('stories', 'StoryController');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
