<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cuti;
use App\Models\Departemen;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('Admin123')
        ]);

        Departemen::create([
            'departemen' => 'Umum'
        ]);

        Departemen::create([
            'departemen' => 'HRGA'
        ]);

        Departemen::create([
            'departemen' => 'GA'
        ]);

        Departemen::create([
            'departemen' => 'Accounting'
        ]);

        Departemen::create([
            'departemen' => 'Marketing'
        ]);

        Departemen::create([
            'departemen' => 'Produksi Gabah'
        ]);

        Departemen::create([
            'departemen' => 'Produksi Beras'
        ]);

        Departemen::create([
            'departemen' => 'Dapur'
        ]);

        Departemen::create([
            'departemen' => 'Driver'
        ]);

        Departemen::create([
            'departemen' => 'Mekanik'
        ]);

        Departemen::create([
            'departemen' => 'Engineering'
        ]);

        Departemen::create([
            'departemen' => 'Security'
        ]);

        Departemen::create([
            'departemen' => 'Logistik'
        ]);

        Cuti::create([
            'cuti' => 'Tahunan',
            'hari' => '12'
        ]);

        Cuti::create([
            'cuti' => 'Menikah',
            'hari' => '3'
        ]);

        Cuti::create([
            'cuti' => 'Istri melahirkan',
            'hari' => '2'
        ]);

        Cuti::create([
            'cuti' => 'Menikahkan anak',
            'hari' => '2'
        ]);

        Cuti::create([
            'cuti' => 'Khitan / Baptis anak',
            'hari' => '2'
        ]);

        Cuti::create([
            'cuti' => 'Wisuda anak',
            'hari' => '1'
        ]);

        Cuti::create([
            'cuti' => 'Melahirkan',
            'hari' => '60'
        ]);

        Cuti::create([
            'cuti' => 'Suami/istri/anak/orang tua/mertua/menantu meninggal dunia',
            'hari' => '2'
        ]);

        Cuti::create([
            'cuti' => 'Anggota keluarga dalam 1 rumah meninggal',
            'hari' => '1'
        ]);
    }
}
