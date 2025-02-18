<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdeasPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [[
            'title' => 'Pengembangan',
            'description' => 'Untuk menciptakan lingkungan yang ramah, kami mengadopsi konsep yang menonjolkan suasana hangat dan alami. Dengan meminimalisir gangguan visual, desain interior yang sederhana ini memungkinkan siswa untuk lebih fokus pada aspek teoritis. Dengan cara ini, kami merangkul keindahan fungsional dan esensi unik dari setiap ruangan.',
            'image_url' => 'https://stpbogor.ac.id/wp-content/uploads/2024/10/Receptionist-Area.png.webp',
            'major_title' => 'Visi & Perencanaan Jurusan Baru',
            'major_description' => 'Menyongsong Masa Depan dengan Program Studi Inovatif Politeknik kami senantiasa berkomitmen untuk memenuhi kebutuhan industri dan masyarakat akan tenaga profesional yang kompeten. Sebagai langkah strategis dalam menghadapi perkembangan teknologi dan tuntutan pasar kerja yang semakin dinamis, kami tengah merencanakan penambahan jurusan baru yang relevan dan berdaya saing tinggi.',
            'major_image_url' => 'https://polteklpp.ac.id/wp-content/uploads/2021/09/profil.jpg',
            // 'is_hero_visible' =
        ]];
        DB::table('ideas')->insert($data);
    }
}
