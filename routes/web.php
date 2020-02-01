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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
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

});
