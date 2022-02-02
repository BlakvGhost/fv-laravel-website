<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('compte/inscription', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('compte/inscription', [RegisteredUserController::class, 'store']);

    Route::get('compte/connexion', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('compte/connexion', [AuthenticatedSessionController::class, 'store']);

    Route::get('compte/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('compte/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('compte/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('compte/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::get('compte/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::get('compte/moi', [AuthenticatedSessionController::class, 'index'])
        ->name('account.current');
});
