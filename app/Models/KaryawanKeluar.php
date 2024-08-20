<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanKeluar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }

    public function getLamaKerjaAttribute()
    {
        $tanggalMasuk = Carbon::parse($this->attributes['tanggal_masuk']);
        $tanggalKontrak = Carbon::parse($this->attributes['created_at']);

        $lamaKerja = $tanggalMasuk->diff($tanggalKontrak);

        return $lamaKerja->format('%y Tahun, %m Bulan, %d Hari');
    }

    public static function jumlahKaryawanKeluar()
    {
        return static::count();
    }
}
