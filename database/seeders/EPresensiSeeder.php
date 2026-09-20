<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Application;

class EPresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Application for E-Presensi if not exists
        $epresensiApp = Application::firstOrCreate(
            ['name' => 'E-Presensi'],
            [
                'url' => 'http://localhost:5178/auth-receiver',
                'description' => 'Sistem absensi digital berbasis lokasi untuk aparat desa.'
            ]
        );

        // 2. Create Permissions for E-Presensi
        $permission = Permission::firstOrCreate(
            ['name' => 'manage-presensi'],
            ['description' => 'Mengelola Data & Pengaturan Presensi']
        );

        // 3. Create Aparat Desa Role
        $aparatRole = Role::firstOrCreate(
            ['name' => 'Aparat Desa'],
            ['description' => 'Perangkat Desa Mengeruda']
        );

        // 4. Assign App & Permission to Aparat Desa
        $aparatRole->applications()->syncWithoutDetaching([$epresensiApp->id]);
        
        // Optionally assign Super Admin to E-Presensi Application and Permission
        $superAdmin = Role::where('name', 'Super Admin')->first();
        if ($superAdmin) {
            $superAdmin->permissions()->syncWithoutDetaching([$permission->id]);
            $superAdmin->applications()->syncWithoutDetaching([$epresensiApp->id]);
        }
    }
}
