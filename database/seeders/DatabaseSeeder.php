<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CPL;
use App\Models\CPMK;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User Data
        User::create([
            'userID' => '901111',
            'pwd' => Hash::make('123456789'),
            'userToken' => 'contohABC',
            'userName' => 'Joko Baswedan',
            'userPhoto' => 'photo.png',
            'userRights' => json_encode(['buatCPL', 'editCPL', 'rancangKurikulum', 'editKurikulum'])
        ]);

        User::create([
            'userID' => 'Aa7610',
            'pwd' => Hash::make('123456789'),
            'userToken' => 'contohDEF',
            'userName' => 'Anis Subianto',
            'userPhoto' => 'photo-1.png',
            'userRights' => json_encode(['cetakLaporan', 'cetakRekap'])
        ]);

        User::create([
            'userID' => 'US$100',
            'pwd' => Hash::make('123456789'),
            'userToken' => 'contohGHI',
            'userName' => 'Prabowo Widodo',
            'userPhoto' => 'photo-2.png',
            'userRights' => json_encode(['buatRPS', 'editRPS', 'buatBasisEvaluasi', 'editBasisEvaluasi', 'cetakLaporan', 'inputNilai'])
        ]);

        // Kelas Data
        Kelas::create([
            'userID' => '901111',
            'kelas' => json_encode([
                'Basis Data Jumat 7.30-10.00'
            ])
        ]);
        Kelas::create([
            'userID' => 'Aa7610',
            'kelas' => json_encode([
                'Grafika Rabu 7.30-10.00',
                'Grafika Kamis 13.30-15.00'
            ])
        ]);
        Kelas::create([
            'userID' => 'US$100',
            'kelas' => json_encode([
                'Algoritma Senin 7.30-10.00',
                'Algoritma Selasa 13.30-15.00',
                'Algoritma Kamis 7.30-10.00'
            ])
        ]);

        // CPL Data
        CPL::create([
            'kodecpl' => 'CPL01',
            'deskripsi' => 'Mampu bekerja sama secara interpersonal'
        ]);
        CPL::create([
            'kodecpl' => 'CPL02',
            'deskripsi' => 'Menginternalisasi nilai keimanan'
        ]);

        // CPMK Data
        CPMK::create([
            'kodecpmk' => 'CPMK011',
            'kodecpl' => 'CPL01',
            'deskripsi' => 'Mampu bekerja sama'
        ]);
        CPMK::create([
            'kodecpmk' => 'CPMK012',
            'kodecpl' => 'CPL01',
            'deskripsi' => 'Mampu berkomunikasi'
        ]);

        // Course Data
    }
}
