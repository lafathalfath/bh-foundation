<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [[
            'description' => 'Will you be in Los Angeles or any other branches any time soon? Stop by the office! Wed love to meet.',
            'address' => '1702 Olympic Boulevard Santa Monica, CA 90404',
            'phone' => '087829331125',
            'email' => 'help.eduguard@gmail.com',
            // 'is_hero_visible' =
        ]];
        DB::table('contact')->insert($data);
    }
}
