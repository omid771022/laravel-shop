<?php

use App\User;
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
    return view('home');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/email/verify', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showVerifyCodeRequestForm')->name('password.request');
Route::post('/password/email/send', 'Auth\ForgotPasswordController@showPasswordEmail')->name('password.email');
Route::post('/password/rest/check-veryify-code', 'Auth\ForgotPasswordController@checkveryifycode')->name('checkveryifycode');
Route::get('/password/rest/checkcode', 'Auth\ForgotPasswordController@checkcode')->middleware('throttle:5,1')->name('checkcode');
Route::get("/password/rest/showFormPassword", 'Auth\ForgotPasswordController@showFormPassword')->name('passwords.showFormPassword');
Route::post('password/update', 'Auth\ForgotPasswordController@passwordUpdate')->name('password.update');



Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', 'DashboardController@index')->name('Dashboard.index');
});  