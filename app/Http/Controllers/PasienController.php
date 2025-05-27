<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
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

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'nik' => 'required|numeric|digits:16',
            'family_phone' => 'nullable|string|max:15',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'alamat_lengkap' => 'required|string',
            'umur' => 'required|numeric|min:1|max:120',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_bpjs' => 'nullable|string|max:20',
        ]);

        // Ambil nama wilayah dari database
        $province = Province::find($request->provinsi);
        $regency = Regency::find($request->kabupaten);
        $district = District::find($request->kecamatan);
        $village = Village::find($request->kelurahan);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        $alamat = "{$request->alamat_lengkap}, Kel. {$village->name}, Kec. {$district->name}, {$regency->name}, Prov. {$province->name}";

        $pasienData = [
            'nik' => $request->nik,
            'family_phone' => $request->family_phone,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'alamat_lengkap' => $request->alamat_lengkap,
            'alamat' => $alamat,
            'umur' => $request->umur,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_bpjs' => $request->no_bpjs,
        ];

        $user->pasien()->updateOrCreate(['user_id' => $user->id], $pasienData);

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
