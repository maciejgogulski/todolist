<?php

use App\Http\Controllers\UserController;
use App\Http\Rest\ProjectApiController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => 'projects'], function () {
        Route::get('/', [ProjectApiController::class, 'index']);
        Route::get('/with-tasks', [ProjectApiController::class, 'projectWithTasks']);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'async']);
    });
});
