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


Route::get('storage/images/{filename}', function ($filename)
{
    return Image::make(storage_path('public/images/' . $filename))->response();
});

Route::get('/', 'HomeController@index')->name('home');

Route::get('/category/{category?}','ShopController@category')->name('category');
Route::get('/product/{category}/{product}.html','ShopController@product')->name('product');

Route::get('/wish_list','WishlistController@wishlist')->name('wishlist');
Route::any('/addtowishlist','WishlistController@addTowishList')->name('addtowishlist');
Route::get('/delete_from_wish_list', 'WishlistController@deletewishlist')->name('deletefromwishlist');

Route::get('/cart','CartController@index')->name('cart');
Route::get('/link','CartController@storlink');
Route::any('/addtocart','CartController@addtocart')->name('addtocart');
Route::any('/updatecart','CartController@updatecart');
Route::any('/deletefromcart','CartController@deletefromcart');



Route::namespace('Admin')->middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', 'IndexController@index');
    Route::resource('category','CategoryController');
    Route::resource('product','ProductController');
    Route::resource('{product}/photo', 'PhotoController');
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
