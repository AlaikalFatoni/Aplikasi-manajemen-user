<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'), // Ganti dengan password yang lebih kuat
            'role' => 'full_access',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'), // Ganti dengan password yang lebih kuat
            'role' => 'basic_user', // Role ini tidak diizinkan masuk ke MemberController
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        echo "Seeder RoleUserSeeder berhasil dijalankan.\n";
    }
}
