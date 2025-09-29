<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/submit-blog',[BlogController::class, 'getForm']);
Route::post('/submit-blog',[BlogController::class, 'storeForm'])->name('submit-blog.post');
