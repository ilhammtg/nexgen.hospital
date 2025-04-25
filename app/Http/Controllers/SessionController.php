<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Auth\Events\Registered;

class SessionController extends Controller
{
    public function index()
    {

        return view('auth.login', [
            'title' => 'Login - Pages | NexGenbot Hospital',
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Password is required',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            } elseif (Auth::user()->role == 'doctor') {
                return redirect('/admin/dokter');
            } elseif (Auth::user()->role == 'nurse') {
                return redirect('/admin/nurse');
            } elseif (Auth::user()->role == 'user') {
                return redirect('/users');
            }
        } else {
            return redirect('/login')->with('error', 'Invalid email or password');
        }
    }

    public function showRegis()
    {
        return view('auth.register', [
            'title' => 'Register - Pages | NexGenbot Hospital',
        ]);
    }

    public function userRegis(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'terms' => 'accepted',
        ]);

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::logout();
        Auth::login($user); // Auto login setelah registrasi

        return redirect()->route('verification.notice'); // Redirect ke halaman verifikasi email
    }


    public function logout()
    {

        Auth::logout();
        return redirect('/login')->with('success', 'Logout successful');
    }
}
