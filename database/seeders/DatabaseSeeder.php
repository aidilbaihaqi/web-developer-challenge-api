<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
            'userRights' => '["buatCPL", "editCPL", "rancangKurikulum", "editKurikulum"]',
            'class' => '["Basis Data Jumat 7.30-10.00"]'
        ]);

        User::create([
            'userID' => 'Aa7610',
            'pwd' => Hash::make('123456789'),
            'userToken' => 'contohDEF',
            'userName' => 'Anis Subianto',
            'userPhoto' => 'photo-1.png',
            'userRights' => '["cetakLaporan", "cetakRekap"]',
            'class' => '["Grafika Rabu 7.30-10.00", "Grafika Kamis 13.30-15.00"]'
        ]);

        User::create([
            'userID' => 'US$100',
            'pwd' => Hash::make('123456789'),
            'userToken' => 'contohGHI',
            'userName' => 'Prabowo Widodo',
            'userPhoto' => 'photo-2.png',
            'userRights' => '["buatRPS", "editRPS", "buatBasisEvaluasi", "editBasisEvaluasi", "cetakLaporan", "inputNilai"]',
            'class' => '["Algoritma Senin 7.30-10.00", "Algoritma Selasa 13.30-15.00", "Algoritma Kamis 7.30-10.00"]'
        ]);

        // CPL Data

        // CPMK Data

        // Course Data
    }
}
