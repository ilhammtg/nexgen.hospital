<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;

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
            'image' => 'default-avatar.png', // default image
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::logout();
        Auth::login($user); // Auto login setelah registrasi

        return redirect()->route('verification.notice'); // Redirect ke halaman verifikasi email
    }

    // auth socialite like google, facebook, github
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Coba cari berdasarkan google_id terlebih dahulu
        $user = User::where('google_id', $googleUser->id)->first();

        // Jika belum ditemukan, coba cari berdasarkan email
        if (!$user) {
            $user = User::where('email', $googleUser->email)->first();
        }

        // Jika user belum ada, buat baru
        if (!$user) {
            $user = User::create([
                'id' => Str::uuid(),
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'image' => 'default-avatar.png', // default image
                'phone' => '-', // default phone
                'role' => 'user', // default role
                'password' => Hash::make(Str::random(16)), // password acak
                'email_verified_at' => now(),
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
        } else {
            // Update token dan google_id jika sudah ada
            $user->update([
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
        }

        Auth::login($user);

        // Redirect berdasarkan role
        switch ($user->role) {
            case 'admin':
                return redirect('/admin');
            case 'doctor':
                return redirect('/admin/dokter');
            case 'nurse':
                return redirect('/admin/nurse');
            case 'user':
            default:
                return redirect('/users');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout successful');
    }
}
