<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Discover\MovieController;
use App\Http\Controllers\Discover\SerieController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

// Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('movies')->controller(MovieController::class)->group(function () {
        Route::get('/search', 'getMoviesSearch');
        Route::get('/top', 'getMoviesTop');
        Route::get('/{id}', 'getMovieDetails');
        Route::get('/', 'getMovies');
    });
    
    Route::prefix('series')->controller(SerieController::class)->group(function () {
        Route::get('/search', 'getSeriesSearch');
        Route::get('/top', 'getSeriesTop');
        Route::get('/{id}', 'getSerieDetails');
        Route::get('/', 'getSeries');
    });
// });
