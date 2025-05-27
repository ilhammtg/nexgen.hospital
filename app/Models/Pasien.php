<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Wilayah\Provinsi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pasien extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id',);
    }


    // Aktifkan mass-assignment
    protected $fillable = [
        'nik',
        'family_phone',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'alamat_lengkap',
        'alamat',
        'umur',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_bpjs',
    ];

    // Non-incrementing & UUID type
    public $incrementing = false;
    protected $keyType = 'string';

    // Auto-generate UUID saat creating
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->id = Str::uuid();
        });
    }
}
