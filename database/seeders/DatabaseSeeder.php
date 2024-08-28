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
        User::create([
            'userID' => '901111',
            'pwd' => Hash::make('123456789'),
            'userName' => 'Joko Baswedan',
            'userPhoto' => 'photo.png',
            'userRights' => '["buatCPL", "editCPL", "rancangKurikulum", "editKurikulum"]'
        ]);

        User::create([
            'userID' => 'Aa7610',
            'pwd' => Hash::make('123456789'),
            'userName' => 'Anis Subianto',
            'userPhoto' => 'photo-1.png',
            'userRights' => '["cetakLaporan", "cetakRekap"]'
        ]);

        User::create([
            'userID' => 'US$100',
            'pwd' => Hash::make('123456789'),
            'userName' => 'Prabowo Widodo',
            'userPhoto' => 'photo-2.png',
            'userRights' => '["buatRPS", "editRPS", "buatBasisEvaluasi", "editBasisEvaluasi", "cetakLaporan", "inputNilai"]'
        ]);
    }
}
