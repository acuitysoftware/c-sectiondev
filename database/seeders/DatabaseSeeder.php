<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CmsSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(SeoSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
