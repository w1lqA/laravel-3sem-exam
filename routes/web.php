<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThingController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\UsageController;

// Главная страница
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Публичные роуты аутентификации
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Защищенные роуты
Route::middleware('auth')->group(function () {
    // Вещи
    Route::resource('things', ThingController::class);
    
    // Места
    Route::resource('places', PlaceController::class);
    
    // Использования
    Route::resource('usages', UsageController::class);
});