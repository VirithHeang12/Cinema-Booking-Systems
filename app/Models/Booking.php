<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'guest_email',
        'payment_method_id',
        'qr_code',
        'total_amount',
        'booking_date',
        'status',
    ];

    /**
     * Get the showseats for the booking.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function showSeats(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ShowSeat::class);
    }

    /**
     * Get the payment method that owns the booking.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the user that owns the booking.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
