<?php

use App\Http\Controllers\Core\AuthController;
use App\Http\Controllers\Core\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Core\ProjectController;
use App\Http\Controllers\Core\ProviderController;
use App\Http\Controllers\Core\RelationController;
use App\Http\Controllers\Core\ServiceController;
use App\Http\Controllers\Core\StatisticsController;
use App\Http\Controllers\Core\UserController;

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

Route::middleware('auth:api')->get('/sasa', function (Request $request) {
    return $request->user();
});

Route::post('/admin/login', [AuthController::class, 'login'])->name('login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:api'], function () {
    // Custom routes
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/users/update-password', [UserController::class, 'updatePassword']);
    Route::get('/dashboard', [StatisticsController::class, 'dashboard']);
    Route::post('/services/activate', [RelationController::class, 'activateService']);
    Route::post('/projects/assign', [RelationController::class, 'useActiveServiceInProject']);
    Route::post('/providers/setup', [RelationController::class, 'setupProviderConfigPerActiveServiceInProject']);

    // API Resources 
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('projects', ProviderController::class);
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('users', UserController::class);
});