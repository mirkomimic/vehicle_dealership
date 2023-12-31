<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    // Route::get('/test', [App\Http\Controllers\HomeController::class, 'test']);
    Route::get('/search', [App\Http\Controllers\HomeController::class, 'search']);

    Route::get('/add_vehicle', [VehicleController::class, 'create']);
    Route::get('vehicle/{id}', [VehicleController::class, 'show']);

    Route::post('/comments/search', [CommentController::class, 'search']);
    Route::post('vehicle/{vehicle}/comment', [CommentController::class, 'store']);
    Route::post('/reply', [CommentController::class, 'reply']);
});
