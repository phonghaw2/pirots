<?php

use App\Http\Controllers\Homepage\HomepageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('homepage.homepage');
// });


Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::post('/register-action', [UserController::class, 'register_action'])->name('register-action');
Route::post('/login-action', [UserController::class, 'login_action'])->name('login-action');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
