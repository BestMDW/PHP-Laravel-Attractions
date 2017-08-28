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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'AttractionsController@index')->name('attractions.index');
Route::get('/{id}', 'AttractionsController@show')->name('attractions.show');

Route::group(['middleware' => ['auth']], function() {
    Route::post('/{attraction}/review', 'ReviewsController@store');
    Route::patch('/{attraction}/review/{review}', 'ReviewsController@update');
});

// Route group for the administration panel.
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function() {
    Route::get('/', function() {
        return view('admin.index');
    })->name('index');

    // Resource controller for the users section in the administrator panel.
    Route::resource('users', 'AdminUsersController');
    // Resource controller for the attractions section in the administrator panel.
    Route::resource('attractions', 'AdminAttractionsController');
});