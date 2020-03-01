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

Route::get('/', 'ProductController@index');
Route::get('/product/category/{id}', 'ProductController@findCategory');
Route::get('/product/detail/{id}', 'ProductController@detail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','verifyIsAdmin']], function () {

    // Category
    Route::get('/admin/createCategory', 'Admin\CategoryController@index');
    Route::post('/admin/createCategory', 'Admin\CategoryController@store');
    Route::get('/admin/editCategory/{id}', 'Admin\CategoryController@edit');
    Route::post('/admin/updateCategory/{id}', 'Admin\CategoryController@update');
    Route::get('/admin/deleteCategory/{id}', 'Admin\CategoryController@delete');

    // Product
    Route::get('/admin/ProductDashboard', 'Admin\ProductController@index');
    Route::get('/admin/createProduct', 'Admin\ProductController@create');
    Route::post('/admin/createProduct', 'Admin\ProductController@store');
    Route::get('/admin/editProduct/{id}', 'Admin\ProductController@edit');
    Route::post('/admin/updateProduct/{id}', 'Admin\ProductController@update');
    Route::get('/admin/deleteProduct/{id}', 'Admin\ProductController@delete');

    // Order
    Route::get('/admin/order', 'Admin\OrderController@orderPanel');
    Route::get('/admin/showOrderItem/{id}', 'Admin\OrderController@showOrderItem');

    //User
    Route::get('/admin/user', 'Admin\UserController@index');



});

Route::group(['middleware' => ['auth']], function () {
    // Add to cart
    Route::get('/product/addToCart', 'ProductController@addToCart');
    Route::get('/product/cart', 'ProductController@showCart')->name('showCart');
    Route::get('/product/cart/deleteItemCart/{id}', 'ProductController@deleteItemCart');
    Route::get('/product/incrementCart', 'ProductController@incrementCart');
    Route::get('/product/decrementCart', 'ProductController@decrementCart');
    Route::post('/product/addQtyToCart', 'ProductController@addQtyToCart');


    Route::get('/product/checkout', 'ProductController@checkout');
    Route::post('/product/createOrder', 'ProductController@createOrder');
    Route::get('/product/showPayment', 'ProductController@showPayment');
});
Route::get('/product/search', 'ProductController@searchProduct');
Route::get('/product/priceRange', 'ProductController@searchProductPrice');
