<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckJsonResultsController;

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

Route::get('health', HealthCheckJsonResultsController::class);

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [UserController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);

        // Notes
        Route::resource('notes', NoteController::class)->except([
            'create',
            'edit'
        ]);

        // Images
        Route::resource('images', ImagesController::class)->except([
            'create',
            'edit'
        ]);
    });

    Route::post('group', [GroupController::class, 'store']);
    Route::post('template', [TemplateController::class, 'store']);
    Route::get('notify', [TemplateController::class, 'notify']);
});