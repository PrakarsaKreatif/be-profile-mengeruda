<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apps = [
            [
                'name' => 'Profile Website',
                'url' => 'http://localhost:5174/auth-receiver',
                'description' => 'Manajemen konten profil dan informasi pemerintahan desa.'
            ],
            [
                'name' => 'Tourism',
                'url' => 'http://localhost:5175/auth-receiver',
                'description' => 'Manajemen objek wisata, agenda, umkm, dan berita.'
            ],
            [
                'name' => 'E-Surat',
                'url' => 'http://localhost:5177/auth-receiver',
                'description' => 'Sistem pelayanan administrasi dan persuratan desa.'
            ]
        ];

        foreach ($apps as $app) {
            Application::firstOrCreate(
                ['name' => $app['name']],
                [
                    'url' => $app['url'],
                    'description' => $app['description']
                ]
            );
        }
    }
}
