<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user()->name;
        return view('user.dashboard', [
            'user' => $user,
        ]);
    }

    public function profile()
    {
        $data = Auth::user();
        $emailFerify = Auth::user()->email_verified_at;
        $formattedDate = Carbon::parse($emailFerify)->translatedFormat('d F Y');
        return view('user.userprofile', [
            'data' => $data,
            'title' => 'Profile - Pages | NexGenbot Hospital',
            'tanggalJoin' => $formattedDate,
        ]);
    }
}
