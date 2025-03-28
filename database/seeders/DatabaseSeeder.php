<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            mMemberLevelSeeder::class,
            mCategorySeeder::class,
            mProgramTypeSeeder::class,
            UserSeeder::class,
            AppSettingSeeder::class,
            AboutPageSeeder::class,
            FrontPageSeeder::class,
            ContactPageSeeder::class,
            IdeasPageSeeder::class,
            SocialMediaSeeder::class,
        ]);
    }
}
