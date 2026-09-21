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
                'url' => env('PROFILE_APP_URL', 'https://mengeruda.id') . '/auth-receiver',
                'description' => 'Manajemen konten profil dan informasi pemerintahan desa.'
            ],
            [
                'name' => 'Tourism',
                'url' => env('TOURISM_APP_URL', 'https://tourism.mengeruda.id') . '/auth-receiver',
                'description' => 'Manajemen objek wisata, agenda, umkm, dan berita.'
            ],
            [
                'name' => 'E-Surat',
                'url' => env('ESURAT_APP_URL', 'https://e-surat.mengeruda.id') . '/auth-receiver',
                'description' => 'Sistem pelayanan administrasi dan persuratan desa.'
            ]
        ];

        foreach ($apps as $app) {
            \App\Models\Application::updateOrCreate(
                ['name' => $app['name']],
                [
                    'url' => $app['url'],
                    'description' => $app['description']
                ]
            );
        }
    }
}
