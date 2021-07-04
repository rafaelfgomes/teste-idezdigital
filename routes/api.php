<?php

use App\Http\Controllers\UserController;
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

$apiVersion = 'v1';

Route::prefix($apiVersion)->group(function () {
    Route::prefix('users')->group(function () {
        Route::post('register', [ UserController::class, 'store' ]);
    });
});



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

