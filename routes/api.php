<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' =>'category'],function(){
    Route::get('/', 'CategoryController@getAllCategories');
    Route::get('/{id}', 'CategoryController@getCategory');
    Route::post('/', 'CategoryController@createCategory')->middleware('auth:api');
    Route::put('/{id}', 'CategoryController@updateCategory')->middleware('auth:api');
    Route::delete('/{id}', 'CategoryController@deleteCategory')->middleware('auth:api');
});

Route::group(['prefix' =>'post'],function(){
    Route::get('/', 'PostController@getAllPosts');
    Route::get('/{id}', 'PostController@getPost');
    Route::post('/', 'PostController@createPost')->middleware('auth:api');
    Route::put('/{id}', 'PostController@updatePost')->middleware('auth:api');
    Route::delete('/{id}', 'PostController@deletePost')->middleware('auth:api');
});

Route::group(['prefix' =>'user'],function(){
    Route::get('/', 'UserController@getAllUsers')->middleware('auth:api');
    Route::get('/{id}', 'UserController@getUser')->middleware('auth:api');
    Route::post('/', 'UserController@createUser')->middleware('auth:api');
    Route::put('/{id}', 'UserController@updateUser')->middleware('auth:api');
    Route::delete('/{id}', 'UserController@deleteUser')->middleware('auth:api');
});

Route::group(['prefix' =>'auth'],function(){
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});