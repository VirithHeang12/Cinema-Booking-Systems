<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            [
                'user_id'                   => 1,
                'guest_email'               => null,
                'payment_method_id'         => 1,
                'qr_code'                   => 'qr_code_1',
                'total_amount'              => 1000,
                'booking_date'              => '2021-01-01 10:00:00',
                'status'                    => 'Confirmed',
            ],
            [
                'user_id'                   => 1,
                'guest_email'               => null,
                'payment_method_id'         => 1,
                'qr_code'                   => 'qr_code_2',
                'total_amount'              => 1000,
                'booking_date'              => '2021-01-01 13:00:00',
                'status'                    => 'Confirmed',
            ],
            [
                'user_id'                   => 1,
                'guest_email'               => null,
                'payment_method_id'         => 1,
                'qr_code'                   => 'qr_code_3',
                'total_amount'              => 1000,
                'booking_date'              => '2021-01-01 16:00:00',
                'status'                    => 'Confirmed',
            ],
            [
                'user_id'                   => 1,
                'guest_email'               => null,
                'payment_method_id'         => 1,
                'qr_code'                   => 'qr_code_4',
                'total_amount'              => 1000,
                'booking_date'              => '2021-01-01 19:00:00',
                'status'                    => 'Confirmed',
            ],
            [
                'user_id'                   => 1,
                'guest_email'               => null,
                'payment_method_id'         => 1,
                'qr_code'                   => 'qr_code_5',
                'total_amount'              => 1000,
                'booking_date'              => '2021-01-01 22:00:00',
                'status'                    => 'Confirmed',
            ],
            [
                'user_id'                   => 1,
                'guest_email'               => null,
                'payment_method_id'         => 1,
                'qr_code'                   => 'qr_code_6',
                'total_amount'              => 1000,
                'booking_date'              => '2021-01-02 10:00:00',
                'status'                    => 'Confirmed',
            ],
            [
                'user_id'                   => 1,
                'guest_email'               => null,
                'payment_method_id'         => 1,
                'qr_code'                   => 'qr_code_7',
                'total_amount'              => 1000,
                'booking_date'              => '2021-01-02 13:00:00',
                'status'                    => 'Confirmed',
            ],
            [
                'user_id'                   => 1,
                'guest_email'               => null,
                'payment_method_id'         => 1,
                'qr_code'                   => 'qr_code_8',
                'total_amount'              => 1000,
                'booking_date'              => '2021-01-02 16:00:00',
                'status'                    => 'Confirmed',
            ],
            [
                'user_id'                   => 1,
                'guest_email'               => null,
                'payment_method_id'         => 1,
                'qr_code'                   => 'qr_code_9',
                'total_amount'              => 1000,
                'booking_date'              => '2021-01-02 19:00:00',
                'status'                    => 'Confirmed',
            ],
            [
                'user_id'                   => 1,
                'guest_email'               => null,
                'payment_method_id'         => 1,
                'qr_code'                   => 'qr_code_10',
                'total_amount'              => 1000,
                'booking_date'              => '2021-01-02 22:00:00',
                'status'                    => 'Confirmed',
            ],
        ];

        foreach ($bookings as $booking) {
            \App\Models\Booking::create($booking);
        }
    }
}
