<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShowSeat extends Model
{
    /** @use HasFactory<\Database\Factories\ShowSeatFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'show_id',
        'seat_id',
        'booking_id',
        'status',
    ];

    /**
     * Get the show that owns the show seat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function show(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Show::class);
    }

    /**
     * Get the seat that owns the show seat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    /**
     * Get the booking that owns the show seat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booking(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

}
