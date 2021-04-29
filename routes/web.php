<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->middleware('auth');

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::post('/register', [RegisterController::class,'create']);

// Route::get('/password', function(){})->name('password.request');

Route::prefix('quiz')->middleware('auth')->group(function () {
    Route::get('/', [QuizController::class, 'index']);
});
Route::prefix('category')->middleware('auth')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
});
Route::prefix('level')->middleware('auth')->group(function () {
    Route::get('/', [LevelController::class, 'index']);
});
Route::prefix('mission')->middleware('auth')->group(function () {
    Route::get('/', [MissionController::class, 'index']);
});
