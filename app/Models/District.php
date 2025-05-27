<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'reg_districts';

    // HATI-HATI! Kamu pakai kolom `regencie_id`, harusnya `regency_id`.
    // Jika tidak bisa diubah, maka isi kolom foreign key secara eksplisit:
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id'); // typo dari strukturmu
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'district_id');
    }
}
