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

    /**
    * Authentification.
    */

    Route::post('validation', 'AuthController@validation');
    Route::post('login', 'AuthController@login');
    Route::post('signin', 'AuthController@signin');


    Route::middleware('auth:api')->group(function ($id) {

        /**
        * Api Resource.
        */

        Route::apiResources([
            'user' => 'User\UserController',
            'file' => 'File\FileController',
            'folder' => 'Folder\FolderController',
            'type' => 'FileType\FileTypeController',
            'category' => 'FolderCategory\FolderCategoryController'
        ]);

        /**
        * User.
        */

        Route::get(
            'user/{user}/relationships/folder',
            [
                'uses' => 'User\UserRelationshipController' . '@userRelationshipFolder',
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
                'uses' => 'User\UserRelationshipController' . '@userRelationshipFile',
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





        /**
        * Folder.
        */


        Route::get(
            'folder/{folder}/relationships/user',
            [
                'uses' => 'Folder\FolderRelationshipController' . '@folderRelationshipUser',
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
                'uses' => 'Folder\FolderRelationshipController' . '@folderRelationshipFile',
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

        /**
        * File.
        */


        Route::get(
            'file/{file}/relationships/user',
            [
                'uses' => 'File\FileRelationshipController' . '@fileRelationshipUser',
                'as' => 'file.relationships.user',
            ]
        );
        Route::get(
            'file/{file}/user',
            [
                'uses' => 'File\FileRelationshipController' . '@user',
                'as' => 'file.user',
            ]
        );
        Route::get(
            'file/{file}/relationships/folder',
            [
                'uses' => 'File\FileRelationshipController' . '@fileRelationshipFolder',
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

        Route::get(
            'file/{file}/relationships/type',
            [
                'uses' => 'File\FileRelationshipController' . '@fileRelationshipType',
                'as' => 'file.relationships.type',
            ]
        );
        Route::get(
            'file/{file}/type',
            [
                'uses' => 'File\FileRelationshipController' . '@type',
                'as' => 'file.type',
            ]
        );


        /**
        * Type.
        */

        Route::get(
            'type/{type}/relationships/category',
            [
                'uses' => 'FileType\FileTypeRelationshipController' . '@typeRelationshipCategory',
                'as' => 'type.relationships.category',
            ]
        );
        Route::get(
            'type/{type}/category',
            [
                'uses' => 'FileType\FileTypeRelationshipController' . '@category',
                'as' => 'type.category',
            ]
        );
        Route::get(
            'type/{type}/relationships/file',
            [
                'uses' => 'FileType\FileTypeRelationshipController' . '@typeRelationshipFile',
                'as' => 'type.relationships.files',
            ]
        );
        Route::get(
            'type/{type}/file',
            [
                'uses' => 'FileType\FileTypeRelationshipController' . '@files',
                'as' => 'type.files',
            ]
        );


        /**
        * Category.
        */

        Route::get(
            'category/{category}/relationships/type',
            [
                'uses' => 'FolderCategory\FolderCategoryRelationshipController' . '@categoryRelationshipType',
                'as' => 'category.relationships.types',
            ]
        );
        Route::get(
            'category/{category}/type',
            [
                'uses' => 'FolderCategory\FolderCategoryRelationshipController' . '@types',
                'as' => 'category.types',
            ]
        );

    }); 
}); 
