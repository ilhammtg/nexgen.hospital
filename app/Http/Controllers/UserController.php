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
        $user = Auth::user()->name;
        return view('user.dashboard', [
            'title' => 'Dashboard - User | NexGenbot Hospital',
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
            'title' => 'Profile - User | NexGenbot Hospital',
            'tanggalJoin' => $formattedDate,
        ]);
    }

    public function BioPasien()
    {
        $userId = Auth::id();
        $data = User::findOrFail($userId);
        return view('user.bioPasien', [
            'title' => 'Biopasien - User | NexGenbot Hospital',
            'data' => $data,
        ]);
    }
    public function formBioPasien()
    {
        $userId = Auth::id();
        $data = User::findOrFail($userId);
        return view('user.form-bioPasien', [
            'title' => 'Form Biopasien - User | NexGenbot Hospital',
            'data' => $data,
        ]);
    }
}
