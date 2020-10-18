<?php

use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Controllers\BoardController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('board')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [BoardController::class, 'userBoards']);
    Route::get('{board}', [BoardController::class, 'show']);
    Route::post('create', [BoardController::class, 'create']);
    Route::patch('{board}', [BoardController::class, 'edit']);
    Route::delete('{board}', [BoardController::class, 'delete']);

});
Route::prefix('task')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
});
