<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class AddressController extends Controller
{
    // Ambil daftar provinsi (gunakan cache untuk efisiensi)
    public function getProvinces()
    {
        $provinces = Cache::remember('provinces_list', 3600, function () {
            return Province::select('id', 'name')->orderBy('name')->get();
        });

        return response()->json($provinces);
    }

    // Ambil kabupaten berdasarkan ID provinsi
    public function getRegencies($province_id)
    {
        $regencies = Regency::where('province_id', $province_id)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($regencies);
    }

    // Ambil kecamatan berdasarkan ID kabupaten
    public function getDistricts($regency_id)
    {
        $districts = District::where('regency_id', $regency_id)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($districts);
    }

    // Ambil kelurahan berdasarkan ID kecamatan
    public function getVillages($district_id)
    {
        $villages = Village::where('district_id', $district_id)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($villages);
    }
}
