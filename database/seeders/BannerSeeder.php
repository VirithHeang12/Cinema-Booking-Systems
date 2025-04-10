<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'image_url'             => '/image/banner-1.jpg',
                'display_start_date'    => '2021-01-01 00:00:00',
                'display_end_date'      => '2021-01-31 23:59:59',
            ],
            [
                'image_url'             => '/image/banner-2.png',
                'display_start_date'    => '2021-02-01 00:00:00',
                'display_end_date'      => '2021-02-28 23:59:59',
            ],
            [
                'image_url'             => '/image/banner-3.jpg',
                'display_start_date'    => '2021-03-01 00:00:00',
                'display_end_date'      => '2021-03-31 23:59:59',
            ],
            [
                'image_url'             => '/image/banner-5.jpg',
                'display_start_date'    => '2021-04-01 00:00:00',
                'display_end_date'      => '2021-04-30 23:59:59',
            ],
            [
                'image_url'             => '/image/banner-6.jpg',
                'display_start_date'    => '2021-05-01 00:00:00',
                'display_end_date'      => '2021-05-31 23:59:59',
            ],
            [
                'image_url'             => 'https://example.com/image6.jpg',
                'display_start_date'    => '2021-05-01 00:00:00',
                'display_end_date'      => '2021-05-31 23:59:59',
            ],
            [
                'image_url'             => 'https://example.com/image7.jpg',
                'display_start_date'    => '2021-05-01 00:00:00',
                'display_end_date'      => '2021-05-31 23:59:59',
            ],
            [
                'image_url'             => 'https://example.com/image8.jpg',
                'display_start_date'    => '2021-05-01 00:00:00',
                'display_end_date'      => '2021-05-31 23:59:59',
            ],
            [
                'image_url'             => 'https://example.com/image9.jpg',
                'display_start_date'    => '2021-05-01 00:00:00',
                'display_end_date'      => '2021-05-31 23:59:59',
            ],
            [
                'image_url'             => 'https://example.com/image10.jpg',
                'display_start_date'    => '2021-05-01 00:00:00',
                'display_end_date'      => '2021-05-31 23:59:59',
            ],
        ];
        
        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
