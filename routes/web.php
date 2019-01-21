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

Route::get('/category/{category?}','ShopController@category')->name('category');
Route::get('/product/{category}/{product}.html','ShopController@product')->name('product');
Route::get('/createRole','ShopController@createRole');

Route::get('/wish_list','WishlistController@wishlist')->name('wishlist');
Route::any('/addtowishlist','WishlistController@addTowishList')->name('addtowishlist');
Route::get('/delete_from_wish_list', 'WishlistController@deletewishlist')->name('deletefromwishlist');

Route::get('/user','UserController@index');
Route::get('/cart','CartController@index')->name('cart');
Route::any('/addtocart','CartController@addtocart')->name('addtocart');
Route::any('/updatecart','CartController@updatecart');
Route::any('/deletefromcart','CartController@deletefromcart');

Route::any('/newAddtoCart','CartController@newAddtoCart');


Route::resource('/checkout','OrderController');

Route::get('/flash_messages',function (){return view('layouts.flash_messages');})->name('flash_messages');
Route::any('/clever_search','SearchController@index');

Route::namespace('Admin')->middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', 'IndexController@index');
    Route::resource('category','CategoryController');
    Route::resource('product','ProductController');
    Route::resource('{product}/photo', 'PhotoController');
    Route::resource('user','UserController');
    Route::resource('role','RoleController');
    Route::resource('order','OrderController');
    Route::resource('order_status','OrderStatusController');
});

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
