<?php

use App\Http\Controllers\dashboard\authController;
use App\Http\Controllers\dashboard\categoriesController;
use App\Http\Controllers\dashboard\commentsController;
use App\Http\Controllers\dashboard\donationsController;
use App\Http\Controllers\dashboard\donationsTypesController;
use App\Http\Controllers\dashboard\galleryController;
use App\Http\Controllers\dashboard\globalController;
use App\Http\Controllers\dashboard\pagesController;
use App\Http\Controllers\dashboard\permissionsController;
use App\Http\Controllers\dashboard\postsController;
use App\Http\Controllers\dashboard\usersController;
use App\Http\Controllers\globalController as websiteGlobalController;
use App\Http\Controllers\donationsController as websiteDonationsController;
use App\Http\Controllers\pagesController as websitePagesController;
use App\Http\Controllers\postsController as websitePostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Dashboard Routes

Route::group(['prefix' => 'dashboard'], function() {

    Route::group(['prefix' => 'auth', 'controller' => authController::class], function() {
       Route::post('login', 'login');
       Route::post('logout', 'logout')->middleware('auth:sanctum');
    });

    Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum', 'controller' => usersController::class], function() {
        Route::get('/', 'getUsers');
        Route::post('create', 'create');
        Route::post('update', 'update');
        Route::post('delete', 'delete');
        Route::get('/{userId}', 'getUser');
    });

    Route::group(['prefix' => 'categories', 'middleware' => 'auth:sanctum', 'controller' => categoriesController::class], function() {
        Route::get('/', 'getCategories');
        Route::post('/create', 'createCategory');
        Route::post('/update', 'updateCategory');
        Route::post('/delete', 'deleteCategories');
        Route::get('/{categoryId}', 'getCategory');
    });

    Route::group(['prefix' => 'donations', 'middleware' => 'auth:sanctum', 'controller' => donationsController::class], function() {
        Route::get('/', 'getDonations');
    });

    Route::group(['prefix' => 'donation-types', 'middleware' => 'auth:sanctum', 'controller' => donationsTypesController::class], function() {
        Route::get('/', 'getTypes');
        Route::post('/create', 'create');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
        Route::get('/{typeId}', 'getType');
    });

    Route::group(['prefix' => 'posts', 'middleware' => 'auth:sanctum', 'controller' => postsController::class], function() {
        Route::get('/', 'getPosts');
        Route::post('/create', 'create');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
        Route::get('/{postId}', 'getPost');
    });

    Route::group(['prefix' => 'pages', 'middleware' => 'auth:sanctum', 'controller' => pagesController::class], function() {
        Route::get('/', 'getPages');
//        Route::post('/create', 'create');
        Route::post('/update', 'update');
//        Route::post('/delete', 'delete');
        Route::get('/{pageId}', 'getPage');
    });

    Route::group(['prefix' => 'comments', 'middleware' => 'auth:sanctum', 'controller' => commentsController::class], function() {
        Route::get('/', 'getComments');
        Route::post('/delete', 'delete');
    });

    Route::group(['prefix' => 'gallery', 'middleware' => 'auth:sanctum', 'controller' => galleryController::class], function() {
        Route::get('/', 'getGallery');
        Route::post('/create', 'addImage');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
    });

    Route::group(['prefix' => 'permissions', 'middleware' => 'auth:sanctum', 'controller' => permissionsController::class], function() {
        Route::get('/', 'getPermissions');
        Route::post('/create', 'create');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
        Route::get('/{permissionId}', 'getPermission');

    });

    Route::group(['middleware' => 'auth:sanctum', 'controller' => globalController::class], function() {
        Route::get('/home', 'home');
        Route::get('/permissions-list', 'permissionsList');
        Route::get('/categories-list', 'categoriesList');
        Route::get('/abilities', 'abilities');
    });

});

// Website Routes
Route::group(['prefix' => 'donations', 'controller' => websiteDonationsController::class], function() {
    Route::get('/', 'getDonations');
    Route::get('/types', 'getDonationsTypes');
    Route::post('/create', 'makeDonation');
});
Route::group(['prefix' => 'pages', 'controller' => websitePagesController::class], function() {
    Route::get('/{pageId}', 'getPage');
});
Route::group(['prefix' => 'posts', 'controller' => websitePostsController::class], function() {
    Route::get('/{postId}', 'getPost');
});
Route::group(['controller' => websiteGlobalController::class], function() {

    Route::get('home', 'home');

});
