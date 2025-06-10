<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NurseController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\DocterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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
        return view('auth.forgot-password')->with('title', 'Forgot Password - Pages | NexGenbot Hospital');
    })->name('password.request');

    //forgot password
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


    //reset password
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

    //route for Data Wilayah
    Route::get('/get-provinces', [AddressController::class, 'getProvinces']);
    Route::get('/get-regencies/{province_id}', [AddressController::class, 'getRegencies']);
    Route::get('/get-districts/{regency_id}', [AddressController::class, 'getDistricts']);
    Route::get('/get-villages/{district_id}', [AddressController::class, 'getVillages']);

    //route view dashboard & user session
    Route::get('/admin', [AdminController::class, 'index'])
        ->middleware('UserAccess:admin');
    Route::get('/dokter', [DocterController::class, 'index'])
        ->middleware('UserAccess:doctor');
    Route::get('/nurse', [NurseController::class, 'index'])
        ->middleware('UserAccess:nurse');
    Route::get('/users', [UserController::class, 'index'])
        ->middleware('UserAccess:user');

    //rooute all role    
    Route::get('/users/profile', [UserController::class, 'profile'])
        ->name('users.profile')->middleware('UserAccess:user,admin,doctor,nurse');
    Route::get('/users/account-setting', [UserController::class, 'userAccount'])
        ->name('users.accountSetting')
        ->middleware('UserAccess:user,admin,doctor,nurse');
    Route::put('/users/account-setting', [UserController::class, 'updateAccount'])
        ->name('users.updateAccount')
        ->middleware('UserAccess:user,admin,doctor,nurse');
    Route::get('/users/change-password', [UserController::class, 'changePassword'])
        ->name('users.changePassword')
        ->middleware('UserAccess:user,admin,doctor,nurse');
    Route::put('/users/change-password', [UserController::class, 'updatePassword'])
        ->middleware('UserAccess:user,admin,doctor,nurse');
    Route::put('/users/reset-image', [UserController::class, 'resetImage'])
        ->name('users.resetImage')->middleware('UserAccess:user,admin,doctor,nurse');


    //route for pasien
    Route::get('/users/biopasien', [PasienController::class, 'index'])
        ->name('users.biopasien')
        ->middleware('UserAccess:user');
    Route::get('/users/EditBiopasien/', [PasienController::class, 'edit'])
        ->name('users.EditBiopasien')
        ->middleware('UserAccess:user');
    Route::put('/users/UpdateBiopasien/', [PasienController::class, 'update'])
        ->name('users.UpdateBiopasien')
        ->middleware('UserAccess:user');
    Route::get('/logout', [SessionController::class, 'logout'])
        ->name('logout');
});


Route::get('/404-error', function () {
    $title = [
        'title' => '404 Error - Pages | NexGenbot Hospital',
    ];
    return view('error', $title);
});


//google auth
Route::get('/auth/redirect', [SessionController::class, 'googleRedirect'])->name('google.login');

Route::get('/auth/google/callback', [SessionController::class, 'googleCallback'])->name('google.callback');
