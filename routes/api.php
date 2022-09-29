<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/

    Route::group(['prefix'=>'user','as'=> 'api.','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::post('login-email',            ['as' => 'user.login','uses' => 'UserController@loginEmail']);
        Route::post('register-email',         ['as' => 'user.register','uses' => 'UserController@registerEmail']);
        Route::post('login-mobile',            ['as' => 'user.login.mobile','uses' => 'UserController@loginMobile']);
        Route::post('phone-varify',            ['as' => 'user.phone.verify','uses' => 'UserController@phoneVerify']);
        Route::post('register-mobile',            ['as' => 'user.register.mobile','uses' => 'UserController@registerMobile']);
        Route::post('otp-varify',       ['as' => 'user.otp.varify','uses' => 'UserController@otpVerify']);
        Route::post('password-forgot-email',  ['as' => 'user.password.forgot','uses' => 'UserController@forgotPasswordbyEmail']);
        Route::post('validate-token',   ['as' => 'user.password.token.validation','uses' => 'UserController@validateToken']);
        Route::post('new-password',   ['as' => 'user.password.reset','uses' => 'UserController@setNewPassword']);

        // Route::group(['as'=>'products.','prefix'=>'products','namespace'=>'App\Http\Controllers\Api'], function () {
        //     Route::get('products', ['as' => 'products.index', 'uses' => 'ProductController@index']);
        // });
        Route::group(['middleware'=>'web'], function () {
            Route::get('register/github',          ['as' => 'gitRedirect',   'uses' => 'UserController@githubRedirect']);
            Route::get('register/callback/github', ['as' => 'gitCallback',   'uses' => 'UserController@githubCallback']);
            Route::get('register/google',          ['as' => 'googleRedirect','uses' => 'UserController@googleRedirect']);
            Route::get('register/callback/google', ['as' => 'googleCallback','uses' => 'UserController@googleCallback']);
        });
      //  Route::group(['middleware'=>'auth:api'], function () {
        Route::get('all',     ['as' => 'user.all',    'uses' => 'UserController@listing']);
        Route::get('{id}',    ['as' => 'user.single', 'uses' => 'UserController@singleUser']);
        Route::post('logout', ['as' => 'user.logout', 'uses' => 'UserController@logOut']);
        Route::get('profile/{id}', ['as' => 'user.profile', 'uses' => 'UserController@userProfile']);
        Route::post('profile/update', ['as' => 'user.profile.update', 'uses' => 'UserController@updateProfile']);
        Route::post('add/account', ['as' => 'user.add.account', 'uses' => 'UserController@addAccount']);
      //  });
    });

    Route::group(['prefix'=>'services','as'=> 'api.','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::get('all', ['as' => 'listing','uses' => 'ServiceController@listing']);
        Route::get('workshop/{id}', ['as' => 'listing.workshop','uses' => 'ServiceController@byWorkshop']);
    });
    Route::group(['prefix'=>'promotions','as'=> 'api.','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::get('all', ['as' => 'listing','uses' => 'PromotionControler@listing']);
    });
    Route::group(['prefix'=>'cars','as'=> 'api.','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::get('all/{id}', ['as' => 'listing','uses' => 'CarController@listing']);
        Route::post('create', ['as' => 'create','uses' => 'CarController@create']);
        Route::post('update', ['as' => 'create','uses' => 'CarController@update']);
    });
    Route::group(['prefix'=>'workshops','as'=> 'api.','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::get('location', ['as' => 'location','uses' => 'WorkshopController@locations']);
    });

    Route::group(['prefix'=>'information','as'=> 'api.','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::get('about', ['as' => 'about','uses' => 'GeneralController@about']);
        Route::get('policy', ['as' => 'policy','uses' => 'GeneralController@policy']);
    });

    Route::group(['prefix'=>'review','as'=> 'api.','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::get('{id}', ['as' => 'review','uses' => 'ReviewController@single']); // Get Single Review by ID
        Route::get('by/{workshop_id}', ['as' => 'review.workshops','uses' => 'ReviewController@byWorksop']); // Get all reviews belongs to workshop
        Route::post('submit', ['as' => 'review.submit','uses' => 'ReviewController@submit']); // Post new Review
    });

    Route::group(['prefix'=>'quote','as'=> 'api.','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::get('pending/user/{id}', ['as' => 'quote.submit','uses' => 'QuoteController@pendingQuotes']); // Get Single Review by ID4
        Route::post('submit', ['as' => 'quote.submit','uses' => 'QuoteController@submit']); // Get Single Review by ID4
        Route::get('accepted/user/{id}', ['as' => 'quote.accepted','uses' => 'QuoteController@pending']); // List of Quotes submited by user
        Route::get('offers/{id}', ['as' => 'quote.pending','uses' => 'QuoteController@offers']); // Get List of requests by quote ID
        Route::get('ongoing/{id}', ['as' => 'quote.ongoing','uses' => 'QuoteController@ongoing']); // Get Booking list of by User ID
    });

    Route::group(['prefix'=>'booking','as'=> 'api.','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::post('submit', ['as' => 'booking.submit','uses' => 'BookingController@submit']);
        Route::post('review', ['as' => 'booking.review','uses' => 'BookingController@review']);
        Route::get('complete/{id} ', ['as' => 'booking.submit','uses' => 'BookingController@complete']);//  Mark booking as completed by booking ID
        Route::get('completed/{id} ', ['as' => 'booking.submit','uses' => 'BookingController@completed']);//  Completed Bookings by user
    });




