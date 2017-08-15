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

Route::get('/user','UserController@getUser');





Route::group(['middleware'=>'auth.user'],function (){
    Route::get('/dashboard','UserController@getDashboard');
    Route::get('/auth/logout','UserController@logout');
});

Route::group(['middleware'=>'guest','prefix'=>'/auth'],function (){
    Route::get('login','UserController@getLogin');
    Route::get('register','UserController@getRegister');
    Route::post('login','UserController@attemptLogin')->name('auth.login');
    Route::post('register','UserController@Register')->name('auth.register');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get_posts','PostController@getPosts');
