<?php

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

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

Route::get('/create-role', function () {
    $role = Role::create(['name' => 'sales representative']);
    if ($role) {
        return "Role is created successfully.";
    }
});

Route::get('/create-permission', function () {
    $permission = permission::create(['name' => 'create do']);
    if ($permission) {
        return "Permission is created successfully.";
    }
});

Route::get('/role-permission', function () {
    $role = Role::where('id', 1)->first();
    $permission = Permission::where('id', 4)->first();

    $permissionToRole = $role->givePermissionTo($permission);
    if ($permissionToRole) {
        return "Permission to role successfully.";
    }
});

Route::get('/user-role', function () {
    $role = Role::where('id', 4)->first();
    $user = User::where('id', 6)->first();

    $roleToUser = $user->assignRole($role);
    if ($roleToUser) {
        return "Role to user successfully.";
    }
});

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user', 'UserController@index')->name('user.index')->middleware(['role:admin']);
    Route::get('/search/supervisor/{id}', 'UserController@search_supervisor')->name('search.supervisor')->middleware(['role:admin']);
    Route::get('/create/userid/{id}', 'UserController@create_userid')->name('create.userid')->middleware(['role:admin']);
    Route::post('/user/store', 'UserController@store')->name('user.store')->middleware(['role:admin']);
    Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit')->middleware(['role:admin']);
    Route::post('/user/update', 'UserController@update')->name('user.update')->middleware(['role:admin']);
    Route::post('/user/change/password', 'UserController@change_password')->name('user.change.password')->middleware(['role:admin']);
    Route::delete('/user/{id}', 'UserController@destroy')->name('user.destroy')->middleware(['role:admin']);

    /**
     * All User Role Related Routes
     */
    Route::get('role/user', 'UserRoleController@index')->name('role.user.index')->middleware(['role:admin']);
    Route::post('/role/user/store', 'UserRoleController@store')->name('role.user.store')->middleware(['role:admin']);
    /**
     * All Designation Related Routes
     */
    Route::get('/designation', 'DesignationController@index')->name('designation.index')->middleware(['role:admin']);
    Route::post('/designation/store', 'DesignationController@store')->name('designation.store')->middleware(['role:admin']);
    Route::get('/designation/edit/{id}', 'DesignationController@edit')->name('designation.edit')->middleware(['role:admin']);
    Route::post('/designation/update', 'DesignationController@update')->name('designation.update')->middleware(['role:admin']);
    Route::delete('/designation/destroy/{id}', 'DesignationController@destroy')->name('designation.destroy')->middleware(['role:admin']);

    /**
     * All Product Related Routes
     */
    Route::get('/product', 'ProductController@index')->name('product.index')->middleware(['role:admin|sales manager']);
    Route::get('/product/create', 'ProductController@create')->name('product.create')->middleware(['role:admin|sales manager']);
    Route::post('/product/store', 'ProductController@store')->name('product.store')->middleware(['role:admin|sales manager']);
    Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware(['role:admin|sales manager']);
    Route::post('/product/update/{id}', 'ProductController@update')->name('product.update')->middleware(['role:admin|sales manager']);
    Route::delete('/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy')->middleware(['role:admin|sales manager']);

    /**
     * All Dealer Related Routes
     */
    Route::get('/dealer', 'DealerController@index')->name('dealer.index')->middleware(['role:admin|sales manager']);
    Route::get('/dealer/show/{id}', 'DealerController@show')->name('dealer.show')->middleware(['role:admin|sales manager']);
    Route::get('/dealer/create', 'DealerController@create')->name('dealer.create')->middleware(['role:admin|sales manager']);
    Route::post('/dealer/store', 'DealerController@store')->name('dealer.store')->middleware(['role:admin|sales manager']);
    Route::get('/dealer/edit/{id}', 'DealerController@edit')->name('dealer.edit')->middleware(['role:admin|sales manager']);
    Route::post('/dealer/update/{id}', 'DealerController@update')->name('dealer.update')->middleware(['role:admin|sales manager']);
    Route::delete('/dealer/destroy/{id}', 'DealerController@destroy')->name('dealer.destroy')->middleware(['role:admin|sales manager']);
    Route::get('/search/dsm/{id}', 'DealerController@search_dsm')->name('search.dsm')->middleware(['role:admin|sales manager']);
    Route::get('/search/sr/{id}', 'DealerController@search_sr')->name('search.sr')->middleware(['role:admin|sales manager']);

    /**
     * All Delivery Order Related Routes
     */
    Route::get('/delivery/order', 'DeliveryOrderController@index')->name('delivery.order.index')->middleware(['role:admin|sales manager|sr']);
    Route::get('/delivery/order/create', 'DeliveryOrderController@create')->name('delivery.order.create')->middleware(['role:admin|sales manager|sr']);
    Route::post('/delivery/order/store', 'DeliveryOrderController@store')->name('delivery.order.store')->middleware(['role:admin|sales manager|sr']);
    Route::get('/search/company/details/{id}', 'DeliveryOrderController@search_company_details')->name('search.company.details')->middleware(['role:admin|sales manager|sr']);
    Route::get('/search/product/size/{id}', 'DeliveryOrderController@search_product_size')->name('search.product.size')->middleware(['role:admin|sales manager|sr']);
    Route::get('/search/product/price/{id}', 'DeliveryOrderController@search_product_price')->name('search.product.price')->middleware(['role:admin|sales manager|sr']);
    Route::get('/order/payment/detail/{id}', 'DeliveryOrderController@payment_detail')->name('order.payment.detail')->middleware(['role:admin|sales manager|sr']);
    Route::post('/order/payment/detail/store', 'DeliveryOrderController@payment_detail_store')->name('order.payment.detail.store')->middleware(['role:admin|sales manager|sr']);

    /**
     * All Notifications Related Routes
     */
    Route::get('/ajax/get/notifications', 'NotificationController@get_notifications')->name('ajax.get.notifications');
    Route::get('/ajax/all/new/orders', 'NotificationController@all_new_orders')->name('ajax.all.new.orders');
    Route::get('/ajax/order/show/{id}', 'NotificationController@show')->name('ajax.order.show');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
