<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }

    public function karyawanKeluar()
    {
        return $this->hasMany(KaryawanKeluar::class);
    }
}
