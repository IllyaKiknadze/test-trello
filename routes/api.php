<?php

use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TaskController;
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

Route::post('login', [ApiLoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('board')->group(function () {
        Route::get('/', [BoardController::class, 'userBoards']);
        Route::get('{board}', [BoardController::class, 'show']);
        Route::post('create', [BoardController::class, 'create']);
        Route::patch('{board}', [BoardController::class, 'edit']);
        Route::delete('{board}', [BoardController::class, 'delete']);
    });

    Route::prefix('task')->group(function () {
        Route::get('{task}', [TaskController::class, 'getSingleTask']);
        Route::post('create', [TaskController::class, 'create']);
        Route::post('set-labels', [TaskController::class, 'setLabels']);
        Route::patch('{task}', [TaskController::class, 'update']);
        Route::delete('{task}', [TaskController::class, 'delete']);
    });

    Route::prefix('labels')->group(function () {
        Route::get('/', [LabelController::class, 'getLabels']);
        Route::post('create', [LabelController::class, 'create']);
        Route::delete('{label}', [LabelController::class, 'delete']);
    });
});
