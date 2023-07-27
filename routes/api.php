<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function () {
// Route::get('/brand/{id}', [BrandController::class, 'models']);
Route::get('/brand/{id}/models', [BrandController::class, 'models']);
Route::get('/brand/{id}/all_models', [BrandController::class, 'all_models']);
Route::post('/add_vehicle', [VehicleController::class, 'store']);
