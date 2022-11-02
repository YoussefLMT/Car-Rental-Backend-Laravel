<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::get('brands', [BrandController::class, 'getBrands']);
Route::post('add-brand', [BrandController::class, 'addNewBrand']);
Route::get('get-brand/{id}', [BrandController::class, 'getBrand']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
