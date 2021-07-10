<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api', 'cors', 'auth']], static function () {
    Route::group(['prefix' => 'products'], static function () {
        Route::get('/get-all', 'ProductController@getAll');
        Route::get('/get', 'ProductController@get');
    });

    Route::group(['prefix' => 'categories'], static function () {
        Route::get('/get-all', 'CategoryController@getAll');
    });

    Route::group(['prefix' => 'sizes'], static function () {
        Route::get('/get-all', 'SizeController@getAll');
    });

    Route::group(['prefix' => 'cart'], static function () {
        Route::get('/get-cart-items', 'CartController@get');
        Route::get('/get-items-count', 'CartController@getItemsCount');
        Route::post('/add-cart-item', 'CartController@create');
        Route::post('/remove-cart-item', 'CartController@delete');
        Route::post('/change-cart-item-count', 'CartController@changeCount');
    });

    Route::get('/get-price-range', 'ProductController@getPriceRange');
    Route::get('/get-filter-fields', 'ProductFilterController@getFilterFields');
});
