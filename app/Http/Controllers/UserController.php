<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('user.dashboard', [
            'title' => 'Dashboard - User | NexGenbot Hospital',
            'user' => Auth::user(),
            'data' => $data,
        ]);
    }

    public function profile()
    {
        $data = Auth::user();
        $emailFerify = Auth::user()->email_verified_at;
        $formattedDate = Carbon::parse($emailFerify)->translatedFormat('d F Y');
        return view('user.userprofile', [
            'data' => $data,
            'title' => 'Profile - User | NexGenbot Hospital',
            'tanggalJoin' => $formattedDate,
        ]);
    }
}
