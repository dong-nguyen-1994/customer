<?php

use Module\Customer\Http\Controllers\Auth\LoginController;
use Module\Customer\Http\Controllers\Auth\ForgotPasswordController;
use Module\Customer\Http\Controllers\Auth\ResetPasswordController;
use Module\Customer\Http\Controllers\Auth\RegisterController;
use Module\Customer\Http\Controllers\Auth\VerificationController;
use Module\Customer\Http\Controllers\Web\ProfileController;

Route::prefix('customer')->middleware(['web'])
    ->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('customer.web.customer.login');
        Route::post('login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout'])->name('customer.web.customer.logout');
        Route::get('logout', [LoginController::class, 'logout']); // @Todo Remove logout GET method
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('customer.web.password.request');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('customer.web.password.update');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('customer.web.password.email');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

        Route::get('/profile', [ProfileController::class, 'profile'])->name('customer.web.customer.profile');
        Route::post('/profile', [ProfileController::class, 'update']);

        if (config('customer.enable_register')) {
            Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('customer.web.customer.register');
            Route::post('/register', [RegisterController::class, 'register']);
        }

        //Verify email
        Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
        Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
        Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});
