<?php

use Illuminate\Http\Request;



Route::group(['prefix'=>'v1','namespace'=>'\Api\V1'],function (){


    Route::group(['prefix'=>'posts'],function (){
        Route::get('get','PostsController@getPosts')->middleware('jwt.token');
        Route::post('get_info','PostsController@getPost');
    });


//    Route::group(['prefix'=>'users'],function (){
//        Route::get('get','PostsController@getUsers');
//    });

    Route::group(['prefix'=>'auth'],function (){
        Route::post('login','UserController@login');
        Route::post('register','UserController@register');
    });



});


//Route::group(['prefix'=>'v2','namespace'=>'\Api\V2'],function (){
//    Route::get('get_posts','PostsController@getPosts');
//});
