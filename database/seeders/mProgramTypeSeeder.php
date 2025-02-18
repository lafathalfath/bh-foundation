<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mProgramTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = [
            ['name' => 'News'],
            ['name' => 'Scholarship'],
            ['name' => 'Programs'],
        ];
        DB::table('m_program_type')->insert($type);
    }
}
