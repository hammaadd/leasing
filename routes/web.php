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
Route::get('/customer/get/selectAjax','CustomerController@dataAjax')->name('customer.selectAjax');
Route::get('/customer/get/byId','CustomerController@getCustomerById')->name('customer.getCustomerById');


//Categories routes
Route::get('/category/all/categories','CategoryController@create')->name('category.add');
Route::post('/category/store','CategoryController@store');
Route::get('/category/edit/{id}','CategoryController@edit');
Route::post('/category/update/{id}','CategoryController@update');
Route::get('/category/delete/{id}','CategoryController@delete');

Route::get('/products/all','ProductsController@index')->name('product.all');
Route::get('/products/add','ProductsController@create')->name('product.add');
Route::post('/products/store','ProductsController@store');
Route::get('/products/edit/{id}','ProductsController@edit')->name('product.edit');
Route::post('/products/update/{id}','ProductsController@update');
Route::get('/products/delete/{id}','ProductsController@delete');

// Purchase Routes
Route::get('/purchase/add','PurchaseController@add')->name('purchase.add');
 
// Route::get('/vendors/add','VendorsController@addView')->name('vendors.add');
// Route::post('/vendors/add','VendorsController@createVendor')->name('create.vendor');
// Route::get('/vendors/all','VendorsController@allVendors')->name('vendors.all');
// Route::get('/vendors/getData/ajax','VendorsController@getVendorss')->name('vendorss.get');
// Route::get('/vendors/{vendors}/edit','VendorsController@edit')->name('vendors.edit');
// Route::post('/vendors/{vendors}/update','VendorsController@update')->name('vendors.update');
// Route::get('/vendors/{vendors}/delete','VendorsController@delete')->name('vendors.delete');
// Route::get('/category/all','CategoryController@index');

Route::get('/product/get/selectAjax','ProductsController@dataAjax')->name('product.selectAjax');
Route::get('/product/get/product/byId','ProductsController@getProductById')->name('product.getProductById');

//Ledger
Route::get('/ledger/all','LedgerController@index')->name('ledger.all');
Route::post('/ledger/add','LedgerController@add')->name('ledger.add');
Route::get('/ledger/getData/ajax','LedgerController@getLedgers')->name('ledger.get');
Route::get('/ledger/get/{ledger}/details','LedgerController@ledgerDetails')->name('ledger.details');
Route::post('/ledger/entry/{ledger}/add','LedgerController@addEntry')->name('ledger.entry.add');
Route::get('/ledger/{id}/entries/ajax','LedgerController@getLedgerEntries')->name('ledger.entries.get');


//Vendors
Route::get('vendor/all','VendorController@index')->name('vendor.all');
Route::post('/vendor/add','VendorController@add')->name('vendor.add');
Route::get('/vendor/getData/ajax','VendorController@getVendors')->name('vendor.get');
Route::get('/vendor/{vendor}/edit','VendorController@editVendor')->name('vendor.edit');
Route::post('/vendor/{vendor}/update','VendorController@updateVendor')->name('vendor.update');
Route::get('/vendor/{vendor}/delete','VendorController@deleteVendor')->name('vendor.delete');
Route::get('/vendor/get/selectAjax','VendorController@dataAjax')->name('vendor.selectAjax');

//Purchase
Route::get('purchase/add','PurchaseController@add')->name('purchase.add');
Route::post('purchase/create','PurchaseController@create')->name('purchase.create');


//Leasing routes
Route::get('/leasing/add','LeasingController@add')->name('leasing.add');
Route::post('/leasing/add','LeasingController@createLeasing')->name('leasing.create');
Route::get('/leasing/all','LeasingController@all')->name('leasing.all');
Route::get('/leasing/getData/ajax','LeasingController@getLeasing')->name('leasing.get');
Route::get('/leasing/view/{leasing}','LeasingController@view')->name('leasing.view');
Route::get('/leasing/edit/{leasing}','LeasingController@edit')->name('leasing.edit');

//Testing routes

Route::get('leasing/installment/plan','LeasingController@installmentPlan')->name('installment.plan');

//Invoices

Route::get('leasing/invoice','LeasingController@invoice')->name('leasing.invoice');
