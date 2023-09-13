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
use App\Http\Controllers\CommentController;

use App\Http\Controllers\UnreadAnnouncementController;
use App\Http\Controllers\SidebarController;

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

Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');

Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
Route::delete('/jobs/{id}/delete', [JobController::class, 'delete'])->name('jobs.delete');
Route::get('jobs/{job}/edit', [JobFileController::class, 'edit'])->name('jobs.edit');
Route::put('jobs/{job}/update', [JobController::class, 'updateJobStatus'])->name('updateJobStatus');
Route::get('/jobs/{id}/update-end-date', [JobController::class, 'updateEndDate'])->name('jobs.updateEndDate');
Route::put('/jobs/{id}/update-job-end-date', [JobController::class, 'updateJobEndDate'])->name('jobs.updateJobEndDate');
Route::post('/jobs/{jobId}/complete', [JobController::class, 'complete'])->name('jobs.complete');
Route::get('/search', [JobController::class, 'search'])->name('search');

Route::get('/files/{id}/download', [JobFileController::class, 'downloadFile'])->name('download.file');
Route::get('/files/{id}/delete', [JobFileController::class, 'deleteFile'])->name('delete.file');
Route::post('/jobs/{job_id}/upload/file_1', [JobFileController::class, 'uploadFile_1'])->name('upload.file_1');
Route::post('/jobs/{job_id}/upload/file_2', [JobFileController::class, 'uploadFile_2'])->name('upload.file_2');


Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');

Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create'); // 'create' メソッドを呼び出す
Route::post('/announcements/create', [AnnouncementController::class, 'store'])->name('announcements.store');
Route::get('/announcements/show/{id}', [AnnouncementController::class, 'show'])->name('announcements.show');



Route::get('/test', function () {
    return view('test');
});

Route::get('/common', function () {
    return view('layouts.common');
});

Route::get('/invoices', [InvoicesController::class, 'index'])->name('invoices.index');
Route::get('/invoice/test', [InvoicesController::class, 'showTestInvoice']);
Route::post('/submit-invoice', [InvoicesController::class, 'submitInvoice'])->name('submitInvoice');
Route::post('/create-pdf-and-save-invoice', [InvoicesController::class, 'createPdfAndSaveInvoice'])->name('createPdfAndSaveInvoice');
Route::post('/update-invoice/{invoiceId}', [InvoicesController::class, 'updateInvoice'])->name('updateInvoice');
Route::get('/inovoices/admin-index', [InvoicesController::class, 'adminIndex'])->name('adminIndex');


Route::get('/dm/{jobId}', [DMController::class, 'index'])->name('dm.index');
Route::post('/dm/store', [DMController::class, 'store'])->name('dm.store');

Route::get('/dm/usersIndex/{receiver_id}', [DMController::class, 'usersIndex'])->name('dm.usersIndex');

Route::post('/dm/users/store/{receiver_id}', [DMController::class, 'usersStore'])->name('dm.usersStore');

Route::get('/dm/create', [DMController::class, 'create'])->name('dm.create');

Route::get('unreadDm', [DMController::class, 'unreadDm'])->name('unreadDm');

Route::post('/comments/store/{dmId}', [CommentController::class, 'store'])->name('comments.store');


Route::get('/pdf', [InvoicesController::class, 'createPdf'])->name('invoices.pdf');

Route::middleware(['auth'])->group(function () {
    // 未読お知らせをカウントするためのルート
    Route::get('/unread-announcements/count', [UnreadAnnouncementController::class, 'countUnreadAnnouncements'])
        ->name('unread-announcements.count');

    // 未読お知らせを既読にするためのルート
    Route::post('/unread-announcements/mark-as-read/{id}', [UnreadAnnouncementController::class, 'markAsRead'])
        ->name('unread-announcements.mark-as-read');
});
