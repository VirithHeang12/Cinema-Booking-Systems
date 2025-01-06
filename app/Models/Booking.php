<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;
    protected $fillable = [
        'guest_email',
        'qr_code',
        'total_amount',
        'booking_date',
        'status',
        'user_id',
        'payment_method_id',
    ];
}
