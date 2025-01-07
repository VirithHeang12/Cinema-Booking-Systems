<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingFB extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFBFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'booking_id',
        'food_and_beverages_id',
        'quantity',
        'amount',
    ];
}
