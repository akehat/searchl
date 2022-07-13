<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\v1\ProviderController;
use App\Http\Controllers\API\v1\ProviderStatusController;
// use App\Http\Controllers\API\v1\ProviderStatisticsController;
// use App\Http\Controllers\API\v1\SearchLogController;

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
Route::apiResource('/v1/providerstatus', ProviderStatusController::class)->middleware('auth:api');
// Route::apiResource('/v1/providerstatistics', ProviderStatisticsController::class)->middleware('auth:api');
// Route::apiResource('/v1/searchlogs', SearchLogController::class)->middleware('auth:api');

Route::middleware('auth:api')->get('/v1/providersByProfession/{profession_type}', [ProviderController::class, 'getprovidersByProfession']);
Route::middleware('auth:api')->get('/v1/availableproviders/{profession_type?}/{longitude?}/{latitude?}/{emergency?}/{range?}/{range_format?}', [ProviderController::class, 'getAvailableProviders']);
