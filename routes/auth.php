<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthenticationController::class, 'createRegister'])
        ->name('register.create');

    Route::post('register', [AuthenticationController::class, 'storeRegister'])
        ->name('register.store');

    Route::get('login', [AuthenticationController::class, 'createLogin'])
        ->name('login.create');

    Route::post('login', [AuthenticationController::class, 'storeLogin'])
        ->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'destroy'])
        ->name('logout');
});
