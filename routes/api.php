<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
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
// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/search/jobtitle={jobTitle}&location={location}', [JobController::class, 'search']);
// Protected Routes 
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('profile', ProfileController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/createjob', [JobController::class, 'store']);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category', [CategoryController::class, 'store']);
});

Route::get('/hello', function () {
    return 'user data';
});
