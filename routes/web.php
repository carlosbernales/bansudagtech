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

//AUTH
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
Route::match(['get', 'post'], '/farmers_farm', [AdminController::class, 'farmers_farm']);
Route::match(['get', 'post'], '/check-rsbsa', [AdminController::class, 'checkRsbsaEdit']);
Route::put('/edit_farmer/{id}', [AdminController::class, 'edit_farmer']);
Route::delete('/delete_farmer/{id}', [AdminController::class, 'delete_farmer']);
Route::match(['get', 'post'], '/calamity_reports', [AdminController::class, 'calamity_reports']);
Route::put('/updateToShorlisted/{id}', [AdminController::class, 'updateToShorlisted']);
Route::match(['get', 'post'], '/multipleUpdateToShorlisted', [AdminController::class, 'multipleUpdateToShorlisted']);
Route::match(['get', 'post'], '/shortlisted_reports', [AdminController::class, 'shortlisted_reports']);
Route::match(['get', 'post'], '/multipleUpdateToOngoing', [AdminController::class, 'multipleUpdateToOngoing']);
Route::put('/updateToOngoing/{id}', [AdminController::class, 'updateToOngoing']);
Route::match(['get', 'post'], '/ongoing_reports', [AdminController::class, 'ongoing_reports']);
Route::match(['get', 'post'], '/multipleUpdateToCompleted', [AdminController::class, 'multipleUpdateToCompleted']);
Route::put('/updateToCompleted/{id}', [AdminController::class, 'updateToCompleted']);
Route::match(['get', 'post'], '/completed_reports', [AdminController::class, 'completed_reports']);
Route::match(['get', 'post'], '/assistances', [AdminController::class, 'assistances']);
Route::match(['get', 'post'], '/add_assistance', [AdminController::class, 'add_assistance']);
Route::delete('/delete_assistance/{id}', [AdminController::class, 'delete_assistance']);
Route::post('/fetch-calamity-reports', [AdminController::class, 'fetchCalamityReports']);



//HOME
Route::match(['get', 'post'], '/home', [HomeController::class, 'home']);
Route::match(['get', 'post'], '/farms', [HomeController::class, 'farms']);
Route::match(['get', 'post'], '/add_farms', [HomeController::class, 'add_farms']);
Route::match(['get', 'post'], '/test', [HomeController::class, 'test']);
Route::delete('/delete_farm/{id}', [HomeController::class, 'delete_farm']);
Route::match(['get', 'post'], '/calamity_report', [HomeController::class, 'calamity_report']);
Route::match(['get', 'post'], '/submit_calamity_report', [HomeController::class, 'submit_calamity_report']);
Route::delete('/delete_report/{id}', [HomeController::class, 'delete_report']);

Route::post('/notifications/update-status', [HomeController::class, 'updateNotifStatus']);







