<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('front-pages.landingpage');
});
Route::get('/login', function () {
    $title = [
        'title' => 'Login - Pages | NexGenbot Hospital',
    ];

    return view('auth.login', $title);
});
Route::get('/register', function () {
    $title = [
        'title' => 'Register - Pages | NexGenbot Hospital',
    ];
    return view('auth.register', $title);
});
Route::get('/forgot-password', function () {
    $title = [
        'title' => 'Forgot Password - Pages | NexGenbot Hospital',
    ];
    return view('auth.forgot-password', $title);
});
