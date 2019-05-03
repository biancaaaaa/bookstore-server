<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('books', 'BookController@index');
Route::get('book/{isbn}', 'BookController@findByISBN');
Route::get('book/checkisbn/{isbn}', 'BookController@checkISBN');
Route::get('book/search/{searchTerm}', 'BookController@findBySearchTerm');

Route::group(['middleware' => ['api', 'cors', 'jwt.auth']], function () {
    Route::post('book', 'BookController@save');
    Route::put('book/{isbn}', 'BookController@update');
    Route::delete('book/{isbn}', 'BookController@delete');
    Route::post('auth/logout', 'Auth\ApiAuthController@logout');
    Route::get('orders', 'OrderController@index');
    Route::get('orders/{uid}', 'OrderController@getFromUser');
    Route::post('order', 'OrderController@save');
    Route::put('statusUpdate/{orderId}', 'OrderController@updateStatus');
    Route::get('userInfo/{uid}', 'UserController@getUser');
    Route::put('userInfo/{uid}', 'UserController@setAddress');
    Route::get('shopUsers', 'UserController@getShopUsers');
    Route::get('getUser', 'Auth\ApiAuthController@getCurrentAuthenticatedUser');
});


Route::group(['middleware' => ['api', 'cors']], function () {
    Route::post('auth/login', 'Auth\ApiAuthController@login');
});


