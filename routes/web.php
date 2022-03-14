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

Route::get('/', 'MainController@home')->name('home');
Route::get('/about', 'MainController@about');

Route::get('/catalog', 'MainController@catalog');
Route::any('/catalog/add', 'MainController@catalog_add');
Route::get('/catalog/rem/{id}', 'MainController@catalog_rem');
Route::get('/catalog/{id}', 'MainController@catalog_view');
Route::get('/catalog/buy/{id}', 'MainController@catalog_buy');

Route::any('/search', 'MainController@search');
Route::get('/profile', 'MainController@profile');
Route::get('/profile/{id}', 'MainController@profile');
Route::get('/profile/give/{id}', 'MainController@profile_give');

Route::get('/register', 'MainController@register')->name('register');
Route::any('/login', 'MainController@login')->name('login');
Route::get('/logout', 'MainController@logout');
Route::any('/registration', 'MainController@registration');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
