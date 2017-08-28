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
Route::get('/top', 'AttractionsController@topRated')->name('attractions.topRated');

Route::group(['middleware' => ['auth']], function() {
    Route::post('/{attraction}/review', 'ReviewsController@store');
    Route::patch('/{attraction}/review/{review}', 'ReviewsController@update');
});

// Route group for the administration panel.
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function() {
    Route::get('/home', function() {
        return view('admin.index');
    })->name('index');

    // Resource controller for the users section in the administrator panel.
    Route::resource('users', 'AdminUsersController');
    // Resource controller for the attractions section in the administrator panel.
    Route::resource('attractions', 'AdminAttractionsController');
    // Resource controller for the reviews section in the administration panel.
    Route::patch('reviews/{id}/visible', 'AdminReviewsController@visible')->name('reviews.visible');
    Route::patch('reviews/{id}/hidden', 'AdminReviewsController@hidden')->name('reviews.hidden');
    Route::resource('reviews', 'AdminReviewsController');
});