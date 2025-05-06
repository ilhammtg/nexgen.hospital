<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $data = User::with('pasien')->findOrFail($userId);
        return view('user.bioPasien', [
            'title' => 'Biopasien - User | NexGenbot Hospital',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $userId = Auth::id();
        $data = User::with('pasien')->findOrFail($userId);
        // $dataPasien = Pasien::findOrFail($userId);
        return view('user.edit-bioPasien', [
            'title' => 'Edit Biopasien - User | NexGenbot Hospital',
            'data' => $data,
            // 'dataPasien' => $dataPasien,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        // Update tabel users
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        // Update tabel pasien
        $user->pasien->update([
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_bpjs' => $request->no_bpjs,
        ]);

        return redirect()->route('users.biopasien')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
