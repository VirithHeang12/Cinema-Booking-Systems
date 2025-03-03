<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    /** @use HasFactory<\Database\Factories\SeatFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'hall_id',
        'seat_type_id',
        'row',
        'number',
    ];

    /**
     * Get the show seats for the seat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function showseats(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ShowSeat::class);
    }

    /**
     * Get the hall that owns the seat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hall(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    /**
     * Get the seat type that owns the seat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seatType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SeatType::class);
    }
}
