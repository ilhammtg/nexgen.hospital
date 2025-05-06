<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('admin.dashboard', [
            'title' => 'Dashboard Admin | NexgenBot Hospital",',
            'user' => Auth::user(),
            'data' => $data,

        ]);
    }

    public function dokter()
    {

        echo "Hallo Dokter";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'>Logout</a>";
    }

    public function nurse()
    {

        echo "Hallo Nurse";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'>Logout</a>";
    }

    public function users()
    {

        echo "Hallo Users";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'>Logout</a>";
    }
}
