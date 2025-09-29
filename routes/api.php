<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\AirportController;

//Route::apiResource('blogs', BlogController::class);

Route::get('/blogs',[BlogController::class, 'index']);
Route::get('/blogs/{slug}', [BlogController::class, 'individualBlog']);
Route::get('/category', [BlogController::class, 'category']);
Route::get('/blogs/category/{category}', [BlogController::class, 'byCategory']);

Route::get('/airports',[AirportController::class, 'allAirports']);
Route::get('/country',[AirportController::class, 'country']);
Route::get('/airport/{country}',[AirportController::class, 'byCountry']);
Route::get('/airport/country/{id}',[AirportController::class, 'airport']);
