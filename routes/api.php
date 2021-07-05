<?php

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

Route::prefix('users')->group(function () {
    Route::get('all', [ UserController::class, 'getAll' ]);
    Route::get('{id}', [ UserController::class, 'getOne' ]);
    Route::get('/', [ UserController::class, 'getUsersByName' ]);
    Route::post('register', [ UserController::class, 'store' ]);
    Route::put('{id}', [ UserController::class, 'update' ]);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

