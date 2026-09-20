<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Application;

class FixWargaAppSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('name', 'warga')->first();
        $app = Application::where('name', 'E-Surat')->first();
        
        if ($role && $app) {
            $role->applications()->syncWithoutDetaching([$app->id]);
        }
    }
}
