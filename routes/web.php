<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

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


Auth::routes();

Route::group(['prefix'=>'admin'], function() {
    Route::get('/login', function () {
        return view('admin.login.login');
    });
});

Route::get('/shopping-cart', 'Users\CartController@show')->name('cart.show');

Route::resource('products', 'Users\ProductController');

Route::get('/shop', function () {
    return view('users.shop.index');
});

Route::get('/home', 'Users\ProductController@index')->name('home');

Route::get('/addToCart/{product}', 'Users\CartController@create')->name('cart.add');

Route::put('/products/{product}', 'Users\CartController@update')->name('cart.update');

Route::delete('/products/{product}', 'Users\CartController@destroy')->name('product.remove');

Route::get('/', 'Users\ProductController@index', function () {
    return view('users.products.index');
});

Route::get('orders/store', 'Users\OrderController@store')->name('orders.store');

Route::get('/addToCart/{product}', 'Users\CartController@create')->name('cart.add');

Route::delete('/products/{product}', 'Users\CartController@destroy')->name('product.remove');

Route::get('language/{language}', 'LanguageController@index')->name('language.index');

Route::group(['namespace' => 'Admin', 'middleware' => 'verified', 'middleware' => 'administrator'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('categories', 'CategoryController')->except([
            'show'
        ]);

        Route::resource('products', 'ProductController')->except([
            'show'
        ]);

        Route::resource('users', 'UserController');
    });
});
