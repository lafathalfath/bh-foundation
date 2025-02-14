<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mMemberLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Dewan Pembina'],
            ['name' => 'Dewan Pengawas'],
            ['name' => 'Yayasan'],
        ];
        DB::table('m_member_level')->insert($data);
    }
}
