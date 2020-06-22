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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'DienthoaiHomeController@index')->name('phones.home');

Route::get('/all-phones', 'DienthoaiHomeController@allPhones')->name('all-phones');
Route::get('/discount-phones', 'DienthoaiHomeController@discountPhones')->name('discount-phones');
Route::get('/danhmuc/{danhmuc}', 'DienthoaiHomeController@danhmuc')->name('danhmuc');
Route::get('/noisanxuat/{noisanxuat}', 'DienthoaiHomeController@noisanxuat')->name('noisanxuat');

Route::get('/phone/{phone}', 'DienthoaiHomeController@phoneDetails')->name('phone-details');

//////////////////////////////////////////////////////////

Route::post('/phone/{phone}/review', 'ReviewsController@store')->name('phone.review');

// Cart Route

//////////////////////////////////////////////////////////////
Route::post('/cart/add', 'ShoppingCartController@add_to_cart')->name('cart.add');
Route::get('/cart/page', 'ShoppingCartController@cart')->name('cart');
Route::get('/cart/delete/{id}', 'ShoppingCartController@cart_delete')->name('cart.delete');
Route::get('/cart/increment/{id}/{qty}/{dienthoai_id}', 'ShoppingCartController@cart_increment')->name('cart.increment');
Route::get('/cart/decrement/{id}/{qty}', 'ShoppingCartController@cart_decrement')->name('cart.decrement');

//////////////////////////////////////////////////////////////

Route::get('/cart/checkout', 'CheckoutController@index')->name('cart.checkout');
Route::post('/cart/proceed', 'CheckoutController@store')->name('cart.proceed');
Route::get('/cart/payment', 'CheckoutController@show')->name('cart.payment');
Route::post('/cart/checkout', 'CheckoutController@pay')->name('cart.checkout');
// End of cart route

Auth::routes();

/*Route::get('/home', 'HomeController@index')->name('home');*/

// Admin Route group
Route::group(['middleware' => 'admin'], function (){
    Route::get('/admin-home', 'Admin\AdminBaseController@index')->name('admin.home');

    Route::put('/admin/phones/restore/{id}', 'Admin\AdminPhonesController@restore')
        ->name('phone.restore');
    Route::delete('admin/phones/forceDelete/{id}', 'Admin\AdminPhonesController@forceDelete')
        ->name('phone.forceDelete');
    Route::get('/trash-phones', 'Admin\AdminPhonesController@trashPhones')
        ->name('admin.trash-phones');
    Route::get('admin/discount-phones', 'Admin\AdminPhonesController@discountPhones')->name('admin.discountPhones');

    ///////////////////////////////////////////////////////////////

    /// đang sửa ở đây
    Route::resource('/admin/phones', 'Admin\AdminPhonesController');
    Route::resource('/admin/danhmuc', 'Admin\AdminCategoriesController');
    Route::resource('/admin/noisanxuat', 'Admin\AdminAuthorsController');

    ////////////////////////////////////////////
    
    Route::resource('/admin/users', 'Admin\AdminUsersController');
    Route::resource('/admin/donhang', 'Admin\AdminOrdersController');
    Route::resource('/admin/danhgia', 'Admin\AdminReviewsController');
});
// End of admin route

// Users route group
Route::group(['middleware' => 'user'], function (){
    Route::get('/user-home', 'Users\UsersBaseController@index')->name('user.home');
    Route::get('/my-orders', 'Users\UserOrdersController@myOrders')->name('user.orders');
    Route::get('/order/details/{id}', 'Users\UserOrdersController@order_details')->name('order.details');

    Route::get('/my-reviews', 'Users\UserReviewsController@myReviews')->name('user.reviews');
    Route::delete('/review-delete/{id}', 'Users\UserReviewsController@deleteReview')->name('review.delete');
});
// End of users route

Route::get('/logout', 'CustomLogoutController@logout')->name('logout');
