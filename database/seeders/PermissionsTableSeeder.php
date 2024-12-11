<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // İzinleri oluştur
        $permissions = [
            'manage users',
            'view reports',
            'edit posts',
            'delete posts',
            'create posts'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Admin rolüne izinleri ata
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions); // Tüm izinleri admin'e ata

        // Kullanıcı rolüne sadece bazı izinleri ata
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions(['view reports']);
    }
}
