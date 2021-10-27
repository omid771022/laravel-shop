<?php

use App\Helper\Cart\Cart;
use App\Events\PaymentSuccessEvent;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Mockery\Generator\StringManipulation\Pass\Pass;

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

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');


Route::get('/', function () {
    return view('home');
});
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/email/verify', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('/singel/course/c-{slug}', 'HomeController@singleCourse')->name('single.course');


Route::get('/password/reset', 'Auth\ForgotPasswordController@showVerifyCodeRequestForm')->name('password.request');
Route::post('/password/email/send', 'Auth\ForgotPasswordController@showPasswordEmail')->name('password.email');
Route::post('/password/rest/check-veryify-code', 'Auth\ForgotPasswordController@checkveryifycode')->name('checkveryifycode');
Route::get('/password/rest/checkcode', 'Auth\ForgotPasswordController@checkcode')->middleware('throttle:5,1')->name('checkcode');
Route::get("/password/rest/showFormPassword", 'Auth\ForgotPasswordController@showFormPassword')->name('passwords.showFormPassword');
Route::post('password/update', 'Auth\ForgotPasswordController@passwordUpdate')->name('password.update');
Route::any('/logout', 'HomeController@logout')->name('logout');
Route::get('/tutor/{username}', 'HomeController@singleTutor')->name('singleTutor');
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', 'DashboardController@index')->name('Dashboard.index');
});
Route::group(['prefix' => 'dashboard/category', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', 'CategoryController@index')->name('category.index');
    Route::post('/store', 'CategoryController@store')->name('categories.store');
    Route::get('/edit/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::post('/update/{id}', 'CategoryController@update')->name('categories.update');
    Route::get('/delete/{id}', 'CategoryController@delete')->name('categories.delete');
    Route::get('/show/{id}', 'CategoryController@show')->name('categories.show');
});
Route::group(['prefix' => 'dashboard/RolePermission', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', 'RolePermissionController@index')->name('RolePermission.index');
    Route::post('/store', 'RolePermissionController@store')->name('RolePermission.store');
    Route::post('/storePermissions', 'RolePermissionController@storePermissions')->name('storePermissions');
    Route::get('/editPermissionRole/{id}', 'RolePermissionController@editPermissionRole')->name('editPermissionRole');
    Route::get('/editRole/{userRole}/{user}', 'RolePermissionController@editRole')->name('editRole');
    Route::post('/updateRole/{id}', 'RolePermissionController@updateRole')->name('updateRole');
    Route::post('/updatePermissionRole/{id}', 'RolePermissionController@updatePermissionRole')->name('updatePermissionRole');
    Route::get('/delete/{user}/role/{role}', 'RolePermissionController@delete')->name('PermissionRole.delete');
    Route::get('/deletePermission/{role}/role/{permission}', 'RolePermissionController@permissionDelete')->name('Permission.delete');
    Route::get('/addPermiison', 'RolePermissionController@addPermiison')->name('addPermiison');
    Route::post('RolePermissionadduser', 'RolePermissionController@adduser')->name('RolePermission.adduser');
});
Route::group(['prefix' => 'dashboard/cource', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', 'CourseController@index')->name('course.index');
    Route::get('/create', 'CourseController@create')->name('course.create');
    Route::post('/store', 'CourseController@store')->name('courses.store');
    Route::get('/destroy/{id}', 'CourseController@delete')->name('courses.destroy');
    Route::get('/edit/{id}', 'CourseController@edit')->name('courses.edit');
    Route::post('/update/{id}', 'CourseController@update')->name('course.update');
    Route::get('/accept/{id}', 'CourseController@accept')->name('course.accept');
    Route::get('/pending/{id}', 'CourseController@pending')->name('course.pending');
    Route::get('/reject/{id}',   'CourseController@reject')->name('course.reject');
    Route::get('/details/{id}', 'CourseController@details')->name('course.details');
});

Route::group(['prefix' => 'dashboard/user', 'middleware' => ['auth', 'verified', 'permission:admin']], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('users/{id}', 'UserController@edit')->name('users.edit');
    Route::post('update/{id}', 'UserController@update')->name('users.update');
    Route::get('/users/destroy/{id}', 'UserController@destroy')->name('users.destroy');
    Route::get('user/manualVerify/{id}', 'UserController@manualVerify')->name('user.manualVerify');
    Route::post('user/photo', 'UserController@Userphoto')->name('user.photo');
    Route::get('/profile', 'UserController@userProfile')->name('user.profile');
    Route::post('users/profile/update', 'UserController@usersProfileUpdate')->name('user.profile.update');

    Route::get('tutors/{username}', 'UserController@viewProfile')->name('viewProfile');
});
Route::group(['prefix' => 'dashboard/seasons', 'middleware' => ['auth', 'verified', 'web']], function () {
    Route::post('/store/{id}',  'SeasonController@store')->name('seasons.store');
    Route::get('/accept/{id}', 'SeasonController@accept')->name('seasons.accept');
    Route::get('/pending/{id}', 'SeasonController@pending')->name('seasons.pending');
    Route::get('/reject/{id}',   'SeasonController@reject')->name('seasons.reject');
    Route::patch('/update/{id}', 'SeasonController@update')->name('season.update');
    Route::get('/edit/{id}',    'SeasonController@edit')->name('seasons.edit');
    Route::get('/delete/{id}', 'SeasonController@delete')->name('seasons.delete');
    Route::get('/lock/{id}',   'SeasonController@lock')->name('seasons.lock');
    Route::get('/open/{id}',  'SeasonController@open')->name('seasons.open');
    Route::get('/upload/{id}', 'SeasonController@upload')->name('season.upload');
});
Route::group(['prefix' => 'dashboard/lesson', 'middleware' => ['auth', 'verified', 'web']], function () {
    Route::post('/store/{id}',  'LessonController@store')->name('lesson.store');
    Route::get('/delete/{id}',  'LessonController@delete')->name('lesson.delete');
    Route::get('/deleteMultiple/{id}', 'LessonController@deleteMultiple')->name('lessons.destroyMultiple');
    Route::get('/accept/{id}', 'LessonController@accept')->name('lesson.accept');
    Route::get('/pending/{id}', 'LessonController@pending')->name('lesson.pending');
    Route::get('/reject/{id}',   'LessonController@reject')->name('lesson.reject');
    Route::get('/lock/{id}',   'LessonController@lock')->name('lesson.lock');
    Route::get('/open/{id}',  'LessonController@open')->name('lesson.open');
    Route::get('/rjectMultiple', 'LessonController@rjectMultiple')->name('lessons.rjectMultiple');
    Route::get('/acceptMultiple', 'LessonController@confirmMultiple')->name('lessons.confirmMultiple');
    Route::get('/leeson/edit/{lessonId}/course/{courseId}', 'LessonController@edit')->name('lessons.edit');
    Route::patch('/leeson/update/{lessonId}/course/{courseId}', 'LessonController@update')->name('lessons.update');
    Route::get('/acceptAll/{id}', 'LessonController@acceptAll')->name('lessons.acceptAll');
});
Route::group(['prefix' => '/media'], function () {

    Route::get('/media/{media}/download', 'MediaController@download')->name('media.download');
});
Route::group(['prefix' => '/cart'], function () {
    Route::post('add/cart/{Course}', 'CartController@addToCart')->name('cart.addToCart');
    Route::get('/', 'CartController@cart')->name('cart.show');
    Route::delete('/delete/{course}', 'CartController@delete')->name('cart.delete');
});

Route::group(['prefix' => '/payment', 'middleware' => ['auth', 'verified', 'web'] ], function () {
    Route::any('/', 'PaymentController@payment')->name('payment.cart');
    Route::any('verfy/callback', 'PaymentController@verify')->name('payment.verfy');
});

Route::get('/test/test', function(){
    event(new PaymentSuccessEvent());
});
   // //todo
    // Route::post('/courses/buy/{id}', 'CourseController@buyCourse')->name('courses.buy');