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



Route::get('/','App\Http\Controllers\MainPageController@index');

Route::get('/addToCart/{product}','App\Http\Controllers\CartController@add');
Route::get('/checkout','App\Http\Controllers\CartController@checkout');

Route::get('/login','App\Http\Controllers\LoginController@showlogin');
Route::get('/register','App\Http\Controllers\LoginController@showregister');

Route::post('/login','App\Http\Controllers\LoginController@login');
Route::post('/register','App\Http\Controllers\LoginController@register');

Route::get('/zarinpalpay/{order}','App\Http\Controllers\PaymentController@zarinpalpay');

Route::get('/zarinpalVerify/{payment}','App\Http\Controllers\PaymentController@zarinpalVerify'); 


