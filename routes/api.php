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
    Route::post('/', 'CategoryController@createCategory');
    Route::put('/{id}', 'CategoryController@updateCategory');
    Route::delete('/{id}', 'CategoryController@deleteCategory');
});

Route::group(['prefix' =>'post'],function(){
    Route::get('/', 'PostController@getAllPosts');
    Route::get('/{id}', 'PostController@getPost');
    Route::post('/', 'PostController@createPost');
    Route::put('/{id}', 'PostController@updatePost');
    Route::delete('/{id}', 'PostController@deletePost');
});

Route::group(['prefix' =>'user'],function(){
    Route::get('/', 'UserController@getAllUsers');
    Route::get('/{id}', 'UserController@getUser');
    Route::post('/', 'UserController@createUser');
    Route::put('/{id}', 'UserController@updateUser');
    Route::delete('/{id}', 'UserController@deleteUser');
});