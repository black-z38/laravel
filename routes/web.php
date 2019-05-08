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

Route::get('/', 'ProductsController@list')->name('Index_Products');
Route::get('/product', 'ProductsController@list')->name('Products');
Route::post('/submit', 'ProductsController@store')->name('Product_store');
