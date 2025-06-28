<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecommendationController;
use Illuminate\Support\Facades\Route;

// Main home page with recommendation form
Route::get('/', [RecommendationController::class, 'index'])->name('home');

// API routes for recommendation system
Route::get('/recommendations', [RecommendationController::class, 'getRecommendations'])->name('recommendations.get');
Route::post('/train', [RecommendationController::class, 'trainModel'])->name('recommendations.train');
Route::post('/orders', [RecommendationController::class, 'addOrder'])->name('recommendations.add-order'); 

// Add product route
Route::post('/products', [RecommendationController::class, 'addProduct'])->name('recommendations.add-product'); 
