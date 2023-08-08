<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\AnnouncementController;

use App\Http\Controllers\UploadController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}/stop', [UserController::class, 'stop'])->name('users.stop');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');

Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');



Route::get('/upload', [UploadController::class, 'showForm'])->name('upload');
Route::post('/upload', [UploadController::class, 'upload']);
