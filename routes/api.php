<?php

use App\Http\Controllers\dashboard\authController;
use App\Http\Controllers\dashboard\categoriesController;
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

});
