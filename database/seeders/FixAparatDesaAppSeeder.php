<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Application;

class FixAparatDesaAppSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('name', 'Aparat Desa')->first();
        $app = Application::where('name', 'E-Surat')->first();
        
        if ($role && $app) {
            $role->applications()->syncWithoutDetaching([$app->id]);
        }
    }
}
