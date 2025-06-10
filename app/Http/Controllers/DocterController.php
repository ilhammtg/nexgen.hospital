<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocterController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('dokter.dashboard', [
            'title' => 'Dashboard Dokter | NexgenBot Hospital",',
            'user' => Auth::user(),
            'data' => $data,

        ]);
    }
}
