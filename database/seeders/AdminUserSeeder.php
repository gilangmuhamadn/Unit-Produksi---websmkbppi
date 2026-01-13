<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'), // ganti sesuai kebutuhan
        ]);

        // Assign role admin (pastikan role ini sudah ada)
        // $role = Role::firstOrCreate(['name' => 'admin']);
        // $admin->roles()->attach($role->id);
    }
}




