<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\v1\ProviderController;
// use App\Http\Resources\v1\ProviderResource;
// use App\Models\Provider;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

/**
 * The basis of this API is based on this tutorial:
 * https://thestartupcto.org/laravel-api-tutorial-build-a-secure-rest-api-in-php-using-laravel-passport-oauth2-0-f74d1f78c01a
 *
 * error handler as JSON:
 * https://laraveldaily.com/laravel-api-404-response-return-json-instead-of-webpage-error/#comment-508883
 */



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route::post('/logout', [AuthController::class, 'logout']);
// Route::middleware(['auth:api'])->get('/logout', function (Request $request) {
//     $request->user()->token()->revoke();
// });

Route::apiResource('/v1/provider', ProviderController::class)->middleware('auth:api');


