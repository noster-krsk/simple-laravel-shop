<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ProductController;
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
// Route::get('/getcategory', function () {
//     return response()->json(['Легкий', 'Хрупкий', 'Тяжелый']);
// });
Route::get('/getcategory', [CategoriesController::class, 'index']);
Route::get('/product', [ProductController::class]);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
