<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MissionController;

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
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/password', function(){})->name('password.request');

Route::prefix('quiz')->group(function () {
    Route::get('/', [QuizController::class, 'index']);
});
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
});
Route::prefix('level')->group(function () {
    Route::get('/', [LevelController::class, 'index']);
});
Route::prefix('mission')->group(function () {
    Route::get('/', [MissionController::class, 'index']);
});
