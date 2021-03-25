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
Route::put('/customer/{customer}/update','CustomerController@update')->name('customer.update');
Route::get('/customer/{customer}/delete','CustomerController@delete')->name('customer.delete');


// Purchase Routes
Route::get('/purchase/add','PurchaseController@add')->name('purchase.add');
