<?php

use App\Http\Controllers\CateApiController;
use App\Http\Controllers\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/categories', [CateApiController::class, 'categories'])->name('categories');
Route::get('/MainCategory', [CateApiController::class, 'MainCategory'])->name('cate.main');
Route::post('/categories/slug', [CateApiController::class, 'generateSlug'])->name('cate.slug.generate');
Route::get('/categories/check', [CateApiController::class, 'checkSlug'])->name('cate.slug.check');
Route::get('/categories/checkExists/{CategoryName?}', [CateApiController::class, 'checkExists'])->name('cate.checkExists');


Route::get('/products', [ProductApiController::class, 'show'])->name('product.show');
