<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::match(['get', 'post'], '/', [AuthController::class, 'landingpage']);
Route::match(['get', 'post'], '/login', [AuthController::class, 'login']);




Route::put('/edit_category/{id}', [AdminController::class, 'category_edit']);
Route::delete('/delete_category/{id}', [AdminController::class, 'delete_category']);

