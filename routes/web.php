<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Orders
    Route::resource('orders', OrderController::class);
    Route::post('/orders/{id}/upload-half-payment', [OrderController::class, 'uploadHalfPayment'])->name('orders.upload-half-payment');
    Route::post('/orders/{id}/approve', [OrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{id}/assign-writer', [OrderController::class, 'assignWriter'])->name('orders.assign-writer');
    Route::post('/orders/{id}/upload-half-file', [OrderController::class, 'uploadHalfFile'])->name('orders.upload-half-file');
    Route::post('/orders/{id}/upload-full-file', [OrderController::class, 'uploadFullFile'])->name('orders.upload-full-file');
    Route::post('/orders/{id}/mark-completed', [OrderController::class, 'markCompleted'])->name('orders.mark-completed');
    Route::post('/orders/{id}/toggle-half-file-visibility', [OrderController::class, 'toggleHalfFileVisibility'])->name('orders.toggle-half-file-visibility');
    Route::post('/orders/{id}/toggle-full-file-visibility', [OrderController::class, 'toggleFullFileVisibility'])->name('orders.toggle-full-file-visibility');
    Route::post('/orders/{id}/upload-full-payment', [OrderController::class, 'uploadFullPayment'])->name('orders.upload-full-payment');
    Route::post('/orders/{id}/verify-full-payment', [OrderController::class, 'verifyFullPayment'])->name('orders.verify-full-payment');

    // Referrals
    Route::get('/referrals', [ReferralController::class, 'index'])->name('referrals.index');
    Route::post('/referrals/generate-code', [ReferralController::class, 'generateCode'])->name('referrals.generate-code');
    Route::post('/referrals/request-withdrawal', [ReferralController::class, 'requestWithdrawal'])->name('referrals.request-withdrawal');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');

    // Reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Meetings
    Route::post('/meetings/request', [MeetingController::class, 'request'])->name('meetings.request');

    // Subjects (Manager & Super Admin only)
    Route::middleware('role:super_admin,manager')->group(function () {
        Route::resource('subjects', SubjectController::class)->except(['index', 'show']);
    });
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->name('subjects.show');

    // Users (Manager & Super Admin only)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::middleware('role:super_admin,manager')->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    });

    // Settings (Super Admin only)
    Route::middleware('role:super_admin')->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
        Route::put('/settings/{id}', [SettingController::class, 'update'])->name('settings.update');
        Route::delete('/settings/{id}', [SettingController::class, 'destroy'])->name('settings.destroy');
    });

    // File Downloads
    Route::get('/orders/{orderId}/files/{fileType}', [FileController::class, 'downloadOrderFile'])->name('orders.files.download');
    Route::get('/orders/{orderId}/attachments/{attachmentIndex}', [FileController::class, 'downloadAttachment'])->name('orders.attachments.download');
});
