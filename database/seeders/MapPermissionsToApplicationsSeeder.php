<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Application;

class MapPermissionsToApplicationsSeeder extends Seeder
{
    public function run(): void
    {
        $profileApp = Application::where('name', 'Profile Website')->first();
        $tourismApp = Application::where('name', 'Tourism')->first();
        $suratApp = Application::where('name', 'E-Surat')->first();
        $presensiApp = Application::where('name', 'E-Presensi')->first();

        $map = [
            'manage-users' => $profileApp,
            'manage-roles' => $profileApp,
            'manage-profile' => $profileApp,
            'manage-org-chart' => $profileApp,
            'manage-map' => $profileApp,
            'manage-demographics' => $profileApp,
            'manage-apb' => $profileApp,
            'manage-activities' => $profileApp,
            'manage-gallery' => $profileApp,
            'manage-news' => $profileApp,
            
            'manage-tourism-profile' => $tourismApp,
            'manage-tourism-places' => $tourismApp,
            'manage-umkm' => $tourismApp,
            'manage-tourism-news' => $tourismApp,
            'manage-tourism-gallery' => $tourismApp,
            
            'manage-surat' => $suratApp,
            'request-surat' => $suratApp,
            
            'manage-presensi' => $presensiApp,
            'request-presensi' => $presensiApp,
        ];

        foreach ($map as $permName => $app) {
            if ($app) {
                Permission::where('name', $permName)->update(['application_id' => $app->id]);
            }
        }
    }
}
