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

        Route::resources([
            'v1/user' => 'user\UserController',
            'v1/folder' => 'folder\FolderController',
            'v1/file' => 'file\FileController',
            'v1/type' => 'type\FileTypeController',
            'v1/categorie' => 'category\FolderCategorieController'
        ]);

    }); 

    Route::namespace('Api\v2')->group(function ($id) {

        Route::apiResources([
            'v2/user' => 'user\UserController',
            'v2/folder' => 'folder\FolderController',
            'v2/file' => 'file\FileController',
            'v2/type' => 'type\FileTypeController',
            'v2/categorie' => 'category\FolderCategorieController'
        ]);

    });
    
});
