<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use App\Http\Controllers\AuthController;


Route::middleware(['guest'])->group(function () {
    Route::get('/', [User\DashboardController::class, 'index'])->name('user.home');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.post');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/home', [Admin\DashboardController::class, 'index'])->name('home');
    Route::get('/user', [Admin\DashboardController::class, 'user'])->name('user');
    Route::post('/user/store', [Admin\DashboardController::class, 'storeUser'])->name('user.store');
    Route::put('/user/update/{id}', [Admin\DashboardController::class, 'updateUser'])->name('user.update');
    Route::delete('/user/delete/{id}', [Admin\DashboardController::class, 'deleteUser'])->name('user.delete');

    Route::resource('templates', Admin\TemplateController::class)->except(['show']);
    Route::patch('templates/{template}/toggle', [Admin\TemplateController::class, 'toggle'])->name('templates.toggle');

    Route::get('categories', [Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::post('categories', [Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::put('categories/{category}', [Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [User\DashboardController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/profile', [User\DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [User\DashboardController::class, 'updateProfile'])->name('profile.update');

    Route::get('/editor/{project}', [User\EditorController::class, 'show'])->name('editor');
    Route::post('/editor/{project}/save', [User\EditorController::class, 'save'])->name('editor.save');
    Route::get('/preview/{project}', [User\EditorController::class, 'preview'])->name('preview');
    Route::get('/download/{project}', [User\EditorController::class, 'download'])->name('download');
});