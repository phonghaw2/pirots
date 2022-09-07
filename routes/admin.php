<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('AdminAlreadyLoggedIn');
Route::post('/login-action', [AuthController::class, 'login_action'])->name('login-action');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-action', [AuthController::class, 'register_action'])->name('register-action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/password', [AuthController::class, 'password'])->name('password');
Route::post('/change-password', [AuthController::class, 'change_password'])->name('change-password');


Route::group([
    'as' => 'categories.',
    'prefix' => 'categories',
], static function(){
    Route::get('/add', [CategoriesController::class, 'add'])->name('add');
    Route::get('/edit', [CategoriesController::class, 'edit'])->name('edit');
    Route::post('/updateCategory', [CategoriesController::class, 'updateCategory'])->name('updateCategory');
    Route::post('/addMain', [CategoriesController::class, 'addMain'])->name('addMain');
    Route::post('/addSub', [CategoriesController::class, 'addSub'])->name('addSub');
    Route::post('/addChild', [CategoriesController::class, 'addChild'])->name('addChild');
});


Route::group([
    'as' => 'products.',
    'prefix' => 'products',
], static function(){
    Route::get('/', [ProductController::class, 'all'])->name('all');
    Route::get('/add', [ProductController::class, 'add'])->name('add');
    Route::post('/store', [ProductController::class, 'store'])->name('store');

});
