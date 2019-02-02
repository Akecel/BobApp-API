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

}); 


Route::middleware('auth:api')->group(function ($id) {

    Route::namespace('Api\v1')->group(function ($id) {

        Route::resource('v1/user', 'UserController');

        Route::resource('v1/folder', 'FolderController');

        Route::resource('v1/file', 'FileController');
        
        Route::resource('v1/type', 'FileTypeController');
        
        Route::resource('v1/categorie', 'FolderCategorieController');

    }); 

    Route::namespace('Api\v2')->group(function ($id) {

        Route::apiResources([
            'v2/user' => 'UserController',
            'v2/folder' => 'FolderController',
            'v2/file' => 'FileController',
            'v2/type' => 'FileTypeController',
            'v2/categorie' => 'FolderCategorieController'
        ]);

    });
    
});
