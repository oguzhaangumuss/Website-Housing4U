<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class, // İzinleri ve rolleri tanımlayan Seeder
            AdminUserSeeder::class,       // Admin kullanıcıyı oluşturan Seeder
            RoleSeeder::class,       // Admin kullanıcıyı oluşturan Seeder
        ]);
    }
}
