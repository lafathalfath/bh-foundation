<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [[
            'title' => 'About Us',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis repellat praesentium nemo, quae inventore consectetur dolor commodi nobis veritatis dolore iusto ipsam ducimus dolores distinctio rerum facere, quidem officia cupiditate!Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis repellat praesentium nemo, quae inventore consectetur dolor commodi nobis veritatis dolore iusto ipsam ducimus dolores distinctio rerum facere, quidem officia cupiditate!Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis repellat praesentium nemo, quae inventore consectetur dolor commodi nobis veritatis dolore iusto ipsam ducimus dolores distinctio rerum facere, quidem officia cupiditate!',
            'image_1_url' => 'https://res.cloudinary.com/teach-simple/image/fetch/f_webp,q_auto/https://teachsimplecom.s3.us-east-2.amazonaws.com/home/featured/iStock-1000887536.jpg-1634363661263.jpg',
            'image_2_url' => 'https://res.cloudinary.com/teach-simple/image/fetch/f_webp,q_auto/https://teachsimplecom.s3.us-east-2.amazonaws.com/home/featured/iStock-1000887536.jpg-1634363661263.jpg',
            'vision' => 'Mauris aliquet ornare tortor, ut mollis arcu luctus quis. Phasellus nec augue malesuada, sagittis ligula vel, faucibus metus. Nam viverra metus eget nunc dignissim.',
            'mision' => 'Mauris aliquet ornare tortor, ut mollis arcu luctus quis. Phasellus nec augue malesuada, sagittis ligula vel, faucibus metus. Nam viverra metus eget nunc dignissim.',
            'bg_color' => '#42A5F5',
            'partners_title' => 'Partners and Network',
            'partners_description' => 'Nullam egestas tellus at enim ornare tristique. Class aptent taciti sociosqu ad litora torquent',
            // 'is_hero_visible' =
        ]];
        DB::table('about_page')->insert($data);
    }
}
