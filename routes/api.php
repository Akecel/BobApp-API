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

        Route::apiResources([
            'user' => 'User\UserController',
            'file' => 'File\FileController',
            'folder' => 'Folder\FolderController',
            'type' => 'Type\FileTypeControllers',
            'categorie' => 'Category\FolderCategorieController'
        ]);

        Route::get(
            'user/{user}/relationships/folder',
            [
                'uses' => 'User\UserRelationshipController' . '@folders',
                'as' => 'user.relationships.folders',
            ]
        );
        Route::get(
            'user/{user}/folder',
            [
                'uses' => 'User\UserRelationshipController' . '@folders',
                'as' => 'user.folders',
            ]
        );

        Route::get(
            'user/{user}/relationships/file',
            [
                'uses' => 'User\UserRelationshipController' . '@file',
                'as' => 'user.relationships.files',
            ]
        );
        Route::get(
            'user/{user}/file',
            [
                'uses' => 'User\UserRelationshipController' . '@files',
                'as' => 'user.files',
            ]
        );


        Route::get(
            'folder/{folder}/relationships/user',
            [
                'uses' => 'Folder\FolderRelationshipController' . '@user',
                'as' => 'folder.relationships.user',
            ]
        );
        Route::get(
            'folder/{folder}/user',
            [
                'uses' => 'Folder\FolderRelationshipController' . '@user',
                'as' => 'folder.user',
            ]
        );
        Route::get(
            'folder/{folder}/relationships/file',
            [
                'uses' => 'Folder\FolderRelationshipController' . '@files',
                'as' => 'folder.relationships.files',
            ]
        );
        Route::get(
            'folder/{folder}/file',
            [
                'uses' => 'Folder\FolderRelationshipController' . '@files',
                'as' => 'folder.files',
            ]
        );


        Route::get(
            'file/{file}/relationships/user',
            [
                'uses' => 'Folder\FolderRelationshipController' . '@user',
                'as' => 'file.relationships.user',
            ]
        );
        Route::get(
            'file/{folder}/user',
            [
                'uses' => 'File\FileRelationshipController' . '@user',
                'as' => 'file.user',
            ]
        );
        Route::get(
            'file/{file}/relationships/folder',
            [
                'uses' => 'File\FileRelationshipController' . '@folders',
                'as' => 'file.relationships.folders',
            ]
        );
        Route::get(
            'file/{file}/folders',
            [
                'uses' => 'File\FileRelationshipController' . '@folders',
                'as' => 'file.folders',
            ]
        );

    }); 
}); 
