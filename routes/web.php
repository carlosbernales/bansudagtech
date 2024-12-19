<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;



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
Route::match(['get', 'post'], '/login_submit', [AuthController::class, 'login_submit']);
Route::match(['get', 'post'], '/register', [AuthController::class, 'register']);
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout']);




//ADMIN

Route::match(['get', 'post'], '/dashboard', [AdminController::class, 'dashboard']);
Route::match(['get', 'post'], '/farmers', [AdminController::class, 'farmers']);
Route::match(['get', 'post'], '/add_farmer', [AdminController::class, 'add_farmer']);
Route::match(['get', 'post'], '/check_rsbsa_add_farmer', [AdminController::class, 'checkRsbsa']);

Route::match(['get', 'post'], '/announcement', [AdminController::class, 'announcement']);
Route::match(['get', 'post'], '/add_announcement', [AdminController::class, 'add_announcement']);
Route::delete('/delete_announcement/{id}', [AdminController::class, 'delete_announcement']);



//HOME
Route::match(['get', 'post'], '/home', [HomeController::class, 'home']);
Route::match(['get', 'post'], '/farms', [HomeController::class, 'farms']);
Route::match(['get', 'post'], '/add_farms', [HomeController::class, 'add_farms']);
Route::match(['get', 'post'], '/test', [HomeController::class, 'test']);








Route::put('/edit_category/{id}', [AdminController::class, 'category_edit']);
Route::delete('/delete_category/{id}', [AdminController::class, 'delete_category']);

