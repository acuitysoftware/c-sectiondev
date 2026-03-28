<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
        	[
                'name' => 'Home',
                'title' => 'Home',
                'slug' => 'home',
            ],
            [
                'name' => 'About Us',
                'title' => 'About Us',
                'slug' => 'about-us',
            ],
            [
                'name' => 'Contact Us',
                'title' => 'Contact Us',
                'slug' => 'contact-us',
            ],
           [
                'name' => 'Statutory Information',
                'title' => 'Statutory Information',
                'slug' => 'statutory-information',
            ],
            [
                'name' => 'Pupil Zone',
                'title' => 'Pupil Zone',
                'slug' => 'pupil-zone',
            ],
            
        ];
        foreach ($datas as $data) {
            Seo::create($data);
        }
    }
}
