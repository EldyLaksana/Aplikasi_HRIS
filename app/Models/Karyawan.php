<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // public function getDateFormat()
    // {
    //     return $this->tanggal_lahir->format('d-m-Y');
    // }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class);
    }

    public function cutiKaryawan()
    {
        return $this->hasMany(CutiKaryawan::class);
    }

    public function getLamaKerjaAttribute()
    {
        $tanggalMasuk = Carbon::parse($this->attributes['tanggal_masuk']);
        $tanggalKontrak = Carbon::parse($this->attributes['kontrak']);
        $sekarang = Carbon::now();

        $lamaKerja = $sekarang->diff($tanggalMasuk);

        return $lamaKerja->format('%y Tahun, %m Bulan, %d Hari');
    }

    public function getSisaKontrakAttribute()
    {
        $tanggalKontrak = Carbon::parse($this->attributes['kontrak']);
        $sekarang = Carbon::now();

        $sisaKontrak = $sekarang->diffInMonths($tanggalKontrak) < 1;
        return $sisaKontrak;
    }

    public function getBaruAttribute()
    {
        $tanggalMasuk = Carbon::parse($this->attributes['tanggal_masuk']);

        $statusPegawai = $this->attributes['status_pegawai'];
        $sekarang = Carbon::now();

        if ($statusPegawai == 'PKWTT') {

            $tahunMasuk = $tanggalMasuk->year;
            $januariAwal = Carbon::create($tahunMasuk, 1, 1);
            $lamaKerja = $januariAwal->diff($sekarang);

            $belumSatuTahun = $lamaKerja->y < 1;
        } else {

            $lamaKerja = $tanggalMasuk->diff($sekarang);

            $belumSatuTahun = $lamaKerja->y < 1;
        }
        return $belumSatuTahun;
    }

    public static function jumlahKaryawan()
    {
        return static::count();
    }
}
