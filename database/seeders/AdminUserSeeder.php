<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Admin rolünü oluştur
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Gerekli izinleri oluştur ve admin rolüne ata
        $permissions = ['manage users', 'view reports'];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $adminRole->syncPermissions($permissions);

        // Admin kullanıcısını oluştur ve rol ata
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'), // Şifreyi değiştirin
            ]
        );

        $admin->assignRole($adminRole);
    }
}
