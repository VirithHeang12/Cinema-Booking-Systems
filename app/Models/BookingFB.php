<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingFB extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFBFactory> */
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'food_and_beverages_id',
        'quantity',
        'amount',
    ];
}
