<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [[
            'app_name' => 'BH-Foundation',
            'logo_url' => 'http://localhost:8000/storage/LOGO-YPB_BULAT.png',
            'logo_banner_url' => 'http://localhost:8000/storage/LOGO-YPB_NOBG.png',
            'primary_color' => '#C17D40',
            'secondary_color' => '#16793C',
            'accent_color' => '#F5C97F',
            'info_color' => '#61CCEF'
        ]];
        DB::table('app_settings')->insert($settings);
    }
}
