<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Admin rolünü oluştur
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Admin kullanıcısını oluştur
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Şifreyi değiştirin
        ])->assignRole($adminRole); // Kullanıcıya admin rolü ata
    }
}
