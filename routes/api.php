<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;

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
Route::put('update-brand/{id}', [BrandController::class, 'updateBrand']);
Route::delete('delete-brand/{id}', [BrandController::class, 'deleteBrand']);


Route::get('cars', [CarController::class, 'getCars']);
Route::post('add-car', [CarController::class, 'addNewCar']);
Route::get('get-car/{id}', [CarController::class, 'getCar']);
Route::put('update-car/{id}', [CarController::class, 'updateCar']);
Route::delete('delete-car/{id}', [CarController::class, 'deleteCar']);


Route::get('reservations', [ReservationController::class, 'getReservations']);
Route::post('add-reservation', [ReservationController::class, 'addReservation']);
Route::get('get-reservation/{id}', [ReservationController::class, 'getReservation']);
Route::put('update-reservation/{id}', [ReservationController::class, 'updateReservation']);
Route::delete('delete-reservation/{id}', [ReservationController::class, 'deleteReservation']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
