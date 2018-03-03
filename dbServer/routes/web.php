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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/upload', 'FileUploadController@index')->name('file.upload');
Route::get('/home', 'HomeController@index');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function() {
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  // Password reset routes
  Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
  Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::namespace('tcAdmin')->prefix('admin')->group(function(){
  Route::get('/categories', 'CategoriesController@index')->name('admin.categories.list');
  Route::post('/categories/add', 'CategoriesController@store')->name('admin.categories.add');
  Route::put('/categories/update/{id}', 'CategoriesController@update')->name('admin.categories.update');
  Route::delete('/categories/delete/{id}', 'CategoriesController@destroy')->name('admin.categories.delete');
});
