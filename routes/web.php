<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// This route to serve the home page of the application
Route::get('/', function () {
    return view('front-pages.landingpage', [
        'title' => 'Home - Pages | NexGenbot Hospital',
    ]);
})->middleware('redirect.auth.dashboard')->name('home');

// Guest-only routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'login']);
    Route::get('/register', [SessionController::class, 'showRegis'])->name('register');
    Route::post('/register', [SessionController::class, 'userRegis'])->name('register.userRegis');
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
    Route::get('/admin', [AdminController::class, 'index'])->middleware('UserAccess:admin');
    Route::get('/admin/dokter', [AdminController::class, 'dokter'])->middleware('UserAccess:doctor');
    Route::get('/admin/nurse', [AdminController::class, 'nurse'])->middleware('UserAccess:nurse');
    Route::get('/users', [UserController::class, 'index'])->middleware('UserAccess:user');
    Route::get('/users', [UserController::class, 'profile'])->name('users.profile')->middleware('UserAccess:user');
    Route::get('/logout', [SessionController::class, 'logout'])->name('logout');
});


Route::get('/forgot-password', function () {
    $title = [
        'title' => 'Forgot Password - Pages | NexGenbot Hospital',
    ];
    return view('auth.forgot-password', $title);
});


// Route::get('/userprofile', function () {
//     $title = [
//         'title' => 'User Profile - Pages | NexGenbot Hospital',
//     ];
//     return view('user.userprofile', $title);
// });

// Route::get('/test-email', function () {
//     Mail::raw('Ini email test SMTP dari Laravel 12.', function ($message) {
//         $message->to('ilhamach2020@gmail.com')
//             ->subject('Test Email SMTP');
//     });

//     return 'Email terkirim!';
// });
