<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
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
                'page_name' => 'About Us',
                'slug' => 'about-us',
            ],
            [
                'page_name' => 'Contact Us',
                'slug' => 'contact-us',
            ],
            [
                'page_name' => 'Statutory Information',
                'slug' => 'statutory-information',
            ],
            [
                'page_name' => 'Pupil Zone',
                'slug' => 'pupil-zone',
            ],
            
        ];
        foreach ($datas as $data) {
            Banner::create($data);
        }
    }
}
