<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NurseController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('nurse.dashboard', [
            'title' => 'Dashboard Nurse | NexgenBot Hospital",',
            'user' => Auth::user(),
            'data' => $data,

        ]);
    }
}
