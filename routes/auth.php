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
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthenticationController::class, 'createRegister'])
        ->name('register.create');

    Route::post('register', [AuthenticationController::class, 'storeRegister'])
        ->name('register.store');

    Route::get('login', [AuthenticationController::class, 'createLogin'])
        ->name('login.create');

    Route::post('login', [AuthenticationController::class, 'storeLogin'])
        ->name('login.store');

    Route::get('/auth/github/redirect', function () {
        return Socialite::driver('github')->setScopes(['read:user', 'public_repo'])->redirect();
    });

    Route::get('/auth/github/callback', function () {
        $githubUser = Socialite::driver('github')->user();


        $user = User::updateOrCreate([
            'github_id'             => $githubUser->id,
        ], [
            'name'                  => $githubUser->name,
            'email'                 => $githubUser->email,
            'github_token'          => $githubUser->token,
            'github_refresh_token'  => $githubUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'destroy'])
        ->name('logout');
});
