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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route group for the administration panel.
Route::middleware(['admin'])->prefix('admin')->group(function() {
    Route::get('/', function() {
        return view('admin.index');
    })->name('admin');

    // Resource controller for the users section in the administrator panel.
    Route::resource('users', 'AdminUsersController');
});