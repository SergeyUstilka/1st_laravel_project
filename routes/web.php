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



Route::get('/', 'HomeController@index')->name('home');

Route::get('/category/{category}','ShopController@category');
Route::get('/category/{category}/{product}','ShopController@product');



Route::get('/admin/12', 'Admin\\IndexController@index');

Route::resource('/admin/category','Admin\\CategoryController');
Route::resource('/admin/product','Admin\\ProductController');

//Route::get('/cart', 'CartController@index');
//Route::post('/cart', 'CartController@add');
//Route::post('/to_order','CartController');
//
//Route::get('/order','OrderController@index');
//Route::get('/order/{order?}','OrderController@index');
//
//Route::resource('/admin/category', 'Admin\\CategoryController');
Auth::routes();


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
