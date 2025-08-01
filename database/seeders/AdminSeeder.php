<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Admin;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Pengaturan username dan password admin
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('password123'),
        ]);
    }
}
