<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrontPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [[
            'hero_title' => 'Yayasan Pusaka Bogor',
            'hero_description' => 'Lestarikan Budaya, Lindungi Warisan. Yayasan Pusaka Bogor menjaga dan melestarikan kekayaan budaya dan sejarah Bogor.',
            'hero_image_url' => 'https://stpbogor.ac.id/wp-content/uploads/2024/08/Dionisius.jpg.webp',
            'hero_bg_color' => '#61CCEF',
            'recent_news_description' => '',
            // 'is_hero_visible' =
        ]];
        DB::table('front_page')->insert($data);
    }
}
