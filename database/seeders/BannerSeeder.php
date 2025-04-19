<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'image_url'             => Storage::url('images/banner-1.jpg'),
                'description'           => 'New Year Sale - Kick off 2021 with big discounts!',
                'display_start_date'    => '2021-01-01 00:00:00',
                'display_end_date'      => '2021-01-31 23:59:59',
            ],
            [
                'image_url'             => Storage::url('images/banner-2.png'),
                'description'           => 'Valentine’s Special Offers - Show your love with a gift!',
                'display_start_date'    => '2021-02-01 00:00:00',
                'display_end_date'      => '2021-02-28 23:59:59',
            ],
            [
                'image_url'             => Storage::url('images/banner-3.jpg'),
                'description'           => 'March Madness - Limited-time spring deals!',
                'display_start_date'    => '2021-03-01 00:00:00',
                'display_end_date'      => '2021-03-31 23:59:59',
            ],
            [
                'image_url'             => Storage::url('images/banner-5.jpg'),
                'description'           => 'April Clearance - Up to 50% off on selected items!',
                'display_start_date'    => '2021-04-01 00:00:00',
                'display_end_date'      => '2021-04-30 23:59:59',
            ],
            [
                'image_url'             => Storage::url('images/banner-6.jpg'),
                'description'           => 'Spring Collection Launch - Fresh styles now available!',
                'display_start_date'    => '2021-04-01 00:00:00',
                'display_end_date'      => '2021-04-30 23:59:59',
            ],
        ];


        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
