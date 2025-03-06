<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'image_url'             => 'https://example.com/image1.jpg',
                'display_start_date'    => '2021-01-01 00:00:00',
                'display_end_date'      => '2021-01-31 23:59:59',
            ],
            [
                'image_url'             => 'https://example.com/image2.jpg',
                'display_start_date'    => '2021-02-01 00:00:00',
                'display_end_date'      => '2021-02-28 23:59:59',
            ],
            [
                'image_url'             => 'https://example.com/image3.jpg',
                'display_start_date'    => '2021-03-01 00:00:00',
                'display_end_date'      => '2021-03-31 23:59:59',
            ],
            [
                'image_url'             => 'https://example.com/image4.jpg',
                'display_start_date'    => '2021-04-01 00:00:00',
                'display_end_date'      => '2021-04-30 23:59:59',
            ],
            [
                'image_url'             => 'https://example.com/image5.jpg',
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
    }
}
