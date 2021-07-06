<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoginController;
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

Route::post('login', [ LoginController::class, 'login' ]);

Route::prefix('accounts')->group(function () {
    Route::get('{id}', [ AccountController::class, 'getOne' ]);
    Route::post('', [ AccountController::class, 'store' ]);
    Route::put('{id}', [ AccountController::class, 'update' ]);
});

Route::prefix('users')->group(function () {
    Route::get('all', [ UserController::class, 'getAll' ]);
    Route::get('{id}', [ UserController::class, 'getOne' ]);
    Route::get('', [ UserController::class, 'getUsersByName' ]);
    Route::post('', [ UserController::class, 'store' ]);
    Route::put('{id}', [ UserController::class, 'update' ]);
});

Route::prefix('contacts')->group(function () {
    Route::put('{id}', []);
});

Route::prefix('transactions')->group(function() {
    Route::get('');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

