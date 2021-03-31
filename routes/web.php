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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user', 'UserController@index')->name('user.index');
    Route::get('/search/supervisor/{id}', 'UserController@search_supervisor')->name('search.supervisor');
    Route::get('/create/userid/{id}', 'UserController@create_userid')->name('create.userid');
    Route::post('/user/store', 'UserController@store')->name('user.store');
    Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('/user/update', 'UserController@update')->name('user.update');
    Route::post('/user/change/password', 'UserController@change_password')->name('user.change.password');
    Route::delete('/user/{id}', 'UserController@destroy')->name('user.destroy');

    /**
     * All Designation Related Routes
     */
    Route::get('/designation', 'DesignationController@index')->name('designation.index');
    Route::post('/designation/store', 'DesignationController@store')->name('designation.store');
    Route::get('/designation/edit/{id}', 'DesignationController@edit')->name('designation.edit');
    Route::post('/designation/update', 'DesignationController@update')->name('designation.update');
    Route::delete('/designation/destroy/{id}', 'DesignationController@destroy')->name('designation.destroy');

    /**
     * All Product Related Routes
     */
    Route::get('/product', 'ProductController@index')->name('product.index');
    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product/store', 'ProductController@store')->name('product.store');
    Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('/product/update/{id}', 'ProductController@update')->name('product.update');
    Route::delete('/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy');

    /**
     * All Dealer Related Routes
     */
    Route::get('/dealer', 'DealerController@index')->name('dealer.index');
    Route::get('/dealer/show/{id}', 'DealerController@show')->name('dealer.show');
    Route::get('/dealer/create', 'DealerController@create')->name('dealer.create');
    Route::post('/dealer/store', 'DealerController@store')->name('dealer.store');
    Route::get('/dealer/edit/{id}', 'DealerController@edit')->name('dealer.edit');
    Route::post('/dealer/update/{id}', 'DealerController@update')->name('dealer.update');
    Route::delete('/dealer/destroy/{id}', 'DealerController@destroy')->name('dealer.destroy');
    Route::get('/search/dsm/{id}', 'DealerController@search_dsm')->name('search.dsm');
    Route::get('/search/sr/{id}', 'DealerController@search_sr')->name('search.sr');

    /**
     * All Delivery Order Related Routes
     */
    Route::get('/delivery/order', 'DeliveryOrderController@index')->name('delivery.order.index');
    Route::get('/delivery/order/create', 'DeliveryOrderController@create')->name('delivery.order.create');
    Route::post('/delivery/order/store', 'DeliveryOrderController@store')->name('delivery.order.store');
    Route::get('/search/company/details/{id}', 'DeliveryOrderController@search_company_details')->name('search.company.details');
    Route::get('/search/product/size/{id}', 'DeliveryOrderController@search_product_size')->name('search.product.size');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
