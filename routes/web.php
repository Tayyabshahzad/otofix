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
    return view('auth.login');
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::get('phone-login', 'App\Http\Controllers\loginPhoneController@login')->name('phone.login');
Route::post('phone-login-process', 'App\Http\Controllers\loginPhoneController@loginProcess')->name('phone.login.process');
Route::get('resend/otp/{id}', 'App\Http\Controllers\loginPhoneController@resendOTP')->name('otp.resend');
Route::post('varify/otp', 'App\Http\Controllers\loginPhoneController@varifyOtp')->name('otp.varify');
Route::get('phone-register', 'App\Http\Controllers\loginPhoneController@register')->name('phone.register');
Route::post('phone-register-process', 'App\Http\Controllers\loginPhoneController@registerProcess')->name('phone.register.process');

Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');

Route::group(['as'=> 'admin.','prefix'=>'admin','middleware' => ['auth','verified'],'namespace'=>'App\Http\Controllers\Admin'], function () {
    Route::get('dashboard', ['as' => 'dashboard','uses' => 'DashboardController@index']);
    Route::get('service',  ['as'  => 'services','uses' => 'ServiceController@index']);
    Route::get('service/create',  ['as'  => 'category.create','uses' => 'ServiceController@create']);
    Route::post('service/store',  ['as'  => 'category.store','uses' => 'ServiceController@store']);
    Route::get('service/edit/{id}',  ['as'  => 'category.edit','uses' => 'ServiceController@edit']);
    Route::post('service/update',  ['as'  => 'category.update','uses' => 'ServiceController@update']);
    Route::post('service/delete',  ['as'  => 'category.delete','uses' => 'ServiceController@delete']);
    Route::get('customers',  ['as'  => 'customers','uses' => 'CustomerController@index']);
    Route::get('customers/edit/{id}',  ['as'  => 'customers.edit','uses' => 'CustomerController@edit']);
    Route::post('customers/update',  ['as'  => 'customer.update','uses' => 'CustomerController@update']);
    Route::get('user/create',  ['as'  => 'user.create','uses' => 'CustomerController@create']);
    Route::post('user/save',  ['as'  => 'user.save','uses' => 'CustomerController@save']);
    Route::get('workshop',  ['as'  => 'workshop','uses' => 'WorkshopController@index']);
    Route::get('workshop/view/{id}',  ['as'  => 'view','uses' => 'WorkshopController@view']);
    Route::get('workshop/create',  ['as'  => 'workshop.create','uses' => 'WorkshopController@create']);
    Route::post('workshop/store',  ['as'  => 'workshop.store','uses' => 'WorkshopController@store']);
    Route::get('workshop/edit/{id}',  ['as'  => 'workshop.edit','uses' => 'WorkshopController@edit']);
    Route::post('workshop/update',  ['as'  => 'workshop.update','uses' => 'WorkshopController@update']);
    Route::post('workshop/assign/services',  ['as'  => 'workshop.assign.services','uses' => 'WorkshopController@setservices']);
    Route::get('promotions',  ['as'  => 'promotions.index','uses' => 'PromotionController@index']);
    Route::get('promotions/create',  ['as'  => 'promotions.create','uses' => 'PromotionController@create']);
    Route::get('promotions/edit/{id}',  ['as'  => 'promotions.edit','uses' => 'PromotionController@edit']);
    Route::post('promotion/store',  ['as'  => 'promotions.store','uses' => 'PromotionController@store']);
    Route::post('promotion/delete',  ['as'  => 'promotions.delete','uses' => 'PromotionController@delete']);
    Route::get('car',  ['as'  => 'car','uses' => 'CarController@index']);
    Route::get('car/create',  ['as'  => 'car.create','uses' => 'CarController@create']);
    Route::post('car/store',  ['as'  => 'car.store','uses' => 'CarController@store']);
    Route::get('car/edit/{id}',  ['as'  => 'car.edit','uses' => 'CarController@edit']);
    Route::post('car/update',  ['as'  => 'car.update','uses' => 'CarController@update']);
    Route::post('car/delete',  ['as'  => 'car.delete','uses' => 'CarController@delete']);
    Route::get('about',  ['as'  => 'about','uses' => 'GenralController@about']);
    Route::post('about/update',  ['as'  => 'about.update','uses' => 'GenralController@aboutUpdate']);
    Route::get('policy',  ['as'  => 'policy','uses' => 'GenralController@policy']);
    Route::post('policy/update',  ['as'  => 'policy.update','uses' => 'GenralController@policyUpdate']);
});


Route::group(['as'=> 'workshop.','prefix'=>'workshop','middleware' => ['auth','verified'],'namespace'=>'App\Http\Controllers\Workshop'], function () {
    Route::get('dashboard', ['as' => 'dashboard','uses' => 'DashboardController@index']);
    Route::get('service',  ['as'  => 'services','uses' => 'ServiceController@index']);
    Route::post('assign/services',  ['as'  => 'assign.services','uses' => 'ServiceController@setservices']);
    Route::get('quotes',  ['as'  => 'quotes','uses' => 'QuoteController@index']);
    Route::post('quote/submit',  ['as'  => 'quote.submit','uses' => 'QuoteController@submit']);
    Route::get('submited/quotes',  ['as'  => 'submited.quotes','uses' => 'QuoteController@submitedQuotes']);
    Route::get('bookings',  ['as'  => 'bookings','uses' => 'BookingController@index']);
    Route::get('bookings/{id}',  ['as'  => 'booking.view','uses' => 'BookingController@view']);
    Route::post('bookings/status',  ['as'  => 'booking.status','uses' => 'BookingController@chnageStatus']);

});


require __DIR__.'/auth.php';
