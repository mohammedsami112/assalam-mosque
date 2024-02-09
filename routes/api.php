<?php

use App\Http\Controllers\dashboard\authController;
use App\Http\Controllers\dashboard\categoriesController;
use App\Http\Controllers\dashboard\commentsController;
use App\Http\Controllers\dashboard\donationsController;
use App\Http\Controllers\dashboard\postsController;
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

Route::group(['prefix' => 'dashboard'], function() {

    Route::group(['prefix' => 'auth', 'controller' => authController::class], function() {
       Route::post('login', 'login');
       Route::post('logout', 'logout')->middleware('auth:sanctum');
    });

    Route::group(['prefix' => 'categories', 'middleware' => 'auth:sanctum', 'controller' => categoriesController::class], function() {
        Route::get('/', 'getCategories');
        Route::post('/create', 'createCategory');
        Route::post('/update', 'updateCategory');
        Route::post('/delete', 'deleteCategories');
    });

    Route::group(['prefix' => 'donations', 'middleware' => 'auth:sanctum', 'controller' => donationsController::class], function() {

        Route::get('/', 'getDonations');

    });

    Route::group(['prefix' => 'posts', 'middleware' => 'auth:sanctum', 'controller' => postsController::class], function() {
        Route::get('/', 'getPosts');
        Route::post('/create', 'create');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
    });

    Route::group(['prefix' => 'comments', 'middleware' => 'auth:sanctum', 'controller' => commentsController::class], function() {
        Route::get('/', 'getComments');
        Route::post('/delete', 'delete');
    });

});
