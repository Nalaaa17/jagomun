<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // PERBAIKAN: Gunakan updateOrCreate untuk menghindari error duplikasi.
        // Ini akan mencari admin dengan username 'admin'. Jika ada, akan diperbarui.
        // Jika tidak ada, akan dibuat yang baru.
        Admin::updateOrCreate(
            ['username' => 'adminjagomun'], // Kunci untuk mencari
            [
                'password' => Hash::make('123') // Data yang diisi/diperbarui
            ]
        );
    }
}
