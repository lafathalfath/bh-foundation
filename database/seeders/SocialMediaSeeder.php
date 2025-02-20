<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'instagram', 'url' => 'https://www.instagram.com/bogorheritagefoundation'],
            ['name' => 'tiktok', 'url' => 'https://www.tiktok.com/@bogorheritagefoundation'],
        ];
        DB::table('social_media')->insert($data);
    }
}
