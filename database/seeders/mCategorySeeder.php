<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Education'],
            ['name' => 'Economy'],
            ['name' => 'Tech'],
            ['name' => 'Politics'],
            ['name' => 'Agriculture'],
        ];
        DB::table('m_category')->insert($data);
    }
}
