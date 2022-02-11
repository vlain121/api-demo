<?php

use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\TaskApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'prefix' => 'tasks',
], function () {
    Route::get('/', [TaskApiController::class, 'index']);
    Route::get('detail/{id}', [TaskApiController::class, 'show']);
    Route::post('create', [TaskApiController::class, 'create']);
});

Route::group([
    'prefix' => 'projects',
], function () {
    Route::get('/', [ProjectApiController::class, 'index']);
    Route::post('create', [ProjectApiController::class, 'create']);
    Route::put('update/{id}', [ProjectApiController::class, 'update']);
    Route::get('detail/{id}', [ProjectApiController::class, 'detail']);
});
