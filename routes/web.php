<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home','HomeController@index')->name('home');
Route::get('/customer/add','CustomerController@addView')->name('customer.add');
Route::post('/customer/add','CustomerController@createCustomer')->name('create.customer');
Route::get('/customer/all','CustomerController@allCustomers')->name('customer.all');
Route::get('/customer/getData/ajax','CustomerController@getCustomers')->name('customers.get');
Route::get('/customer/{customer}/edit','CustomerController@edit')->name('customer.edit');
Route::post('/customer/{customer}/update','CustomerController@update')->name('customer.update');
Route::get('/customer/{customer}/delete','CustomerController@delete')->name('customer.delete');
Route::get('/category/all','CategoryController@index');
Route::get('/customer/image/{imgId}/delete','CustomerController@deleteCnicImage')->name('customer.delete.cnic');


Route::get('/category/all/categories','CategoryController@create')->name('category.add');
Route::post('/category/store','CategoryController@store');
Route::get('/category/edit/{id}','CategoryController@edit');
Route::post('/category/update/{id}','CategoryController@update');
Route::get('/category/delete/{id}','CategoryController@delete');

Route::get('/products/all','ProductsController@index');
Route::get('/products/add','ProductsController@create');
Route::post('/products/store','ProductsController@store');
Route::get('/products/edit/{id}','ProductsController@edit');
Route::post('/products/update/{id}','ProductsController@update');
Route::get('/products/delete/{id}','ProductsController@delete');
// Purchase Routes
Route::get('/purchase/add','PurchaseController@add')->name('purchase.add');
 
Route::get('/vendors/add','VendorsController@addView')->name('vendors.add');
Route::post('/vendors/add','VendorsController@createVendor')->name('create.vendor');
Route::get('/vendors/all','VendorsController@allVendors')->name('vendors.all');
Route::get('/vendors/getData/ajax','VendorsController@getVendorss')->name('vendorss.get');
Route::get('/vendors/{vendors}/edit','VendorsController@edit')->name('vendors.edit');
Route::post('/vendors/{vendors}/update','VendorsController@update')->name('vendors.update');
Route::get('/vendors/{vendors}/delete','VendorsController@delete')->name('vendors.delete');
Route::get('/category/all','CategoryController@index');