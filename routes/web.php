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

Auth::routes();
Auth::routes([
    'register' => false,
    'verify' => true,
    'reset' => false
]);

Route::middleware('auth')->group(function () {

    Route::middleware('admin')->group(function () {

        Route::get('/', 'HomeController@index');

        Route::namespace('Admin')->group(function ($id) {

            Route::resource('user', 'UserController');
            Route::resource('file', 'FileController');
            Route::resource('folder', 'FolderController');
            //Route::resource('foldercategorie', 'FolderCategorieController');
            //Route::resource('filetype', 'FileTypeController');
            
        });
    }); 

});


