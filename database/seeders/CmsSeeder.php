<?php

namespace Database\Seeders;
use App\Models\Cms;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
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
                'title' => 'Home',
                'slug' => 'home',
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
            ],
            [
                'title' => 'Statutory Information',
                'slug' => 'statutory-information',
            ],
            [
                'title' => 'Pupil Zone',
                'slug' => 'pupil-zone',
            ],
        ];
        foreach ($datas as $data) {
            Cms::create($data);
        }
    }
}
