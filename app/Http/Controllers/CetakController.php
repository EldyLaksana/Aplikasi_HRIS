<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function cetak_pdf(Karyawan $karyawan, $id)
    {
        $karyawan = Karyawan::find($id);
        return ($karyawan);
    }
}
