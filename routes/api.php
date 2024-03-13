<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('cars', [CarController::class, 'index']);

Route::post('cars/create', [CarController::class, 'create']);
Route::post('cars/update/{id}', [CarController::class, 'update']);

Route::delete('cars/delete/{id}',[CarController::class, 'delete']);