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

Route::namespace('Api')->group(function ($id) {

    Route::post('user/validation', 'AuthController@validation');
    Route::post('user/login', 'AuthController@login');

    Route::middleware('auth:api')->group(function ($id) {

        Route::resource('user', 'UserController');

        Route::resource('folder', 'FolderController');

        Route::resource('file', 'FileController');
        
        Route::resource('type', 'FileTypeController');
        
        Route::resource('categorie', 'FolderCategorieController');

    }); 
    
});
