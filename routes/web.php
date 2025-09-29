<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\AdminLoginController;

Route::get('/admin/login', [AdminLoginController::class, 'showForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AdminLoginController::class, 'logout']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
Route::get('/', function () {
    return view('admin.login');
});


Route::get('/submit-blog',[BlogController::class, 'getForm'])->name('submit-blog');
Route::post('/submit-blog',[BlogController::class, 'storeForm'])->name('submit-blog.post');
