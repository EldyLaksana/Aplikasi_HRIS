<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiKaryawan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    // public function tambahCuti()
    // {
    //     $jumlah_cuti = $this->jumlah_hari;
    //     $jatah_cuti = $this->getJatahCuti();

    //     if ($jatah_cuti >= $jumlah_cuti) {
    //         $this->update(['jatah_cuti' => $jatah_cuti - $jumlah_cuti]);

    //         return true;
    //     } else {
    //         return false;
    //     }

    //     // return $jatah_cuti;
    // }

    // public function getJatahCuti()
    // {
    //     return $this->jatah_cuti;
    // }
    // public function ambilCuti()
    // {
    //     $jumlah_cuti = $this->jumlah_hari;
    //     $jatah_cuti = $this->sisaCuti();

    //     if ($jatah_cuti < $jumlah_cuti) {
    //         return false;
    //     }

    //     // $jatah_cuti -= $jumlah_cuti;
    //     $this->update(['jatah_cuti' => $jatah_cuti -= $jumlah_cuti]);

    //     // $this->save();
    //     return $jatah_cuti;
    // }

    // public function sisaCuti()
    // {
    //     return $this->jatah_cuti;
    // }
}
