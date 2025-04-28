<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AdminController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


//Test route to test email sending functionality
// Route::get('/test-email', function () {
//     Mail::raw('Ini email test SMTP dari Laravel 12.', function ($message) {
//         $message->to('ilhamach2020@gmail.com')
//             ->subject('Test Email SMTP');
//     });

//     return 'Email terkirim!';
// });

// This route to serve the home page of the application
Route::get('/', function () {
    return view('front-pages.landingpage', [
        'title' => 'Home - Pages | NexGenbot Hospital',
    ]);
})->middleware('redirect.auth.dashboard')->name('home');

// Guest-only routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SessionController::class, 'index'])
        ->name('login');
    Route::post('/login', [SessionController::class, 'login']);
    Route::get('/register', [SessionController::class, 'showRegis'])
        ->name('register');
    Route::post('/register', [SessionController::class, 'userRegis'])
        ->name('register.userRegis');
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email');
    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', [
            'token' => $token,
            'title' => 'Reset Password - Pages | NexGenbot Hospital',
        ]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/email/verify', fn() => view('auth.verify-email')->with('title', 'Verify Email - Pages | NexGenbot Hospital'))->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        $role = $request->user()->role;

        return match ($role) {
            'admin' => redirect('/admin'),
            'doctor' => redirect('/admin/dokter'),
            'nurse' => redirect('/admin/nurse'),
            'user' => redirect('/users'),
            default => redirect('/'),
        };
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// Fully verified users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->middleware('UserAccess:admin');
    Route::get('/admin/dokter', [AdminController::class, 'dokter'])
        ->middleware('UserAccess:doctor');
    Route::get('/admin/nurse', [AdminController::class, 'nurse'])
        ->middleware('UserAccess:nurse');
    Route::get('/users', [UserController::class, 'index'])
        ->middleware('UserAccess:user');
    Route::get('/users/profile', [UserController::class, 'profile'])
        ->name('users.profile')->middleware('UserAccess:user');
    Route::get('/users/biopasien', [UserController::class, 'BioPasien'])
        ->name('users.biopasien')
        ->middleware('UserAccess:user');
    Route::get('/users/form-biopasien', [UserController::class, 'formBioPasien'])
        ->name('users.form-biopasien')
        ->middleware('UserAccess:user');
    Route::get('/logout', [SessionController::class, 'logout'])
        ->name('logout');
});


Route::get('/forgot-password', function () {
    $title = [
        'title' => 'Forgot Password - Pages | NexGenbot Hospital',
    ];
    return view('auth.forgot-password', $title);
});

Route::get('/404-error', function () {
    $title = [
        'title' => '404 Error - Pages | NexGenbot Hospital',
    ];
    return view('error', $title);
});



Route::get('/reset-password', function () {
    $title = [
        'title' => 'Reset Password - Pages | NexGenbot Hospital',
    ];
    return view('auth.reset-password', $title);
});


// //Router forgot password & reset password
// Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])
//     ->name('password.request');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
//     ->name('password.email');

// Route::get('/reset-password/{token?}', [ResetPasswordController::class, 'showResetForm'])
//     ->middleware('guest', 'throttle:0,1')
//     ->name('password.reset');
// Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])
//     ->name('password.update');
