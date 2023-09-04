<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\JobFileController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\CustomLogoutController;
use App\Http\Controllers\DMController;


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
    return view('auth.login');
});

Route::get('logout', [CustomLogoutController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}/stop', [UserController::class, 'stop'])->name('users.stop');




Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::resource('jobs', JobController::class);
Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
Route::post('jobs/store', [JobController::class, 'store'])->name('jobs.store');

Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
Route::delete('/jobs/{id}/delete', [JobController::class, 'delete'])->name('jobs.delete');
Route::get('jobs/{job}/edit', [JobFileController::class, 'edit'])->name('jobs.edit');
Route::put('jobs/{job}/update', [JobController::class, 'updateJobStatus'])->name('updateJobStatus');
Route::put('/jobs/{id}/update-end-date', [JobController::class, 'updateEndDate'])->name('jobs.updateEndDate');

Route::get('/files/{id}/download', [JobFileController::class, 'downloadFile'])->name('download.file');
Route::get('/files/{id}/delete', [JobFileController::class, 'deleteFile'])->name('delete.file');
Route::post('/jobs/{job_id}/upload/file_1', [JobFileController::class, 'uploadFile_1'])->name('upload.file_1');
Route::post('/jobs/{job_id}/upload/file_2', [JobFileController::class, 'uploadFile_2'])->name('upload.file_2');

Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');

Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');


Route::get('/test', function () {
    return view('test');
});

Route::get('/common', function () {
    return view('layouts.common');
});

Route::get('/invoices', [InvoicesController::class, 'index'])->name('invoices.index');

Route::get('/dm', [DMController::class, 'index'])->name('dm.index');

Route::get('/pdf', [InvoicesController::class, 'createPdf'])->name('invoices.pdf');
