<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api', 'cors', 'auth']], static function () {

    Route::get('/get-price-range', 'ProductController@getPriceRange');
    Route::get('/get-filter-fields', 'ProductFilterController@getFilterFields');

    Route::group(['prefix' => 'products'], static function () {
        Route::get('/get-all', 'ProductController@getAll');
        Route::get('/get', 'ProductController@get');
        Route::get('/get-popular', 'ProductController@getPopularProducts');
    });

    Route::group(['prefix' => 'categories'], static function () {
        Route::get('/get-all', 'CategoryController@getAll');
    });

    Route::group(['prefix' => 'sizes'], static function () {
        Route::get('/get-all', 'SizeController@getAll');
    });

    Route::group(['prefix' => 'cart'], static function () {
        Route::get('/get-cart-items', 'CartItemController@get');
        Route::get('/get-items-count', 'CartItemController@getItemsCount');
        Route::post('/add-cart-item', 'CartItemController@create');
        Route::post('/remove-cart-item', 'CartItemController@delete');
        Route::post('/change-cart-item-count', 'CartItemController@changeCount');
    });

    Route::group(['prefix' => 'discount'], static function () {
        Route::get('/get', 'DiscountController@get');
        Route::get('/get-codes', 'DiscountController@getAvailableCodes');
        Route::post('/add-code', 'DiscountController@addCode');
    });

    Route::group(['prefix' => 'clients'], static function () {
        Route::get('/get-client', 'ClientController@getClient');
        Route::post('/change-language', 'ClientController@changeLanguage');
    });
});
