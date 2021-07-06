<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::prefix('login')->group(function () {
    Route::post('', [ LoginController::class, 'login' ]);
});

Route::prefix('users')->group(function () {
    Route::post('', [ UserController::class, 'store' ]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('all', [ UserController::class, 'getAll' ]);
        Route::get('{id}', [ UserController::class, 'getOne' ]);
        Route::get('', [ UserController::class, 'getUsersByName' ]);
        Route::put('{id}', [ UserController::class, 'update' ]);
    });

    Route::prefix('accounts')->group(function () {
        Route::get('{id}', [ AccountController::class, 'getOne' ]);
        Route::post('', [ AccountController::class, 'store' ]);
        Route::put('{id}', [ AccountController::class, 'update' ]);
    });

    Route::prefix('transactions')->group(function() {
        Route::post('', [ TransactionController::class, 'store' ]);
    });
});
