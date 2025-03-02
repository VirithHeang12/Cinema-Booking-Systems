<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HallSeatType extends Model
{
    /** @use HasFactory<\Database\Factories\HallSeatTypeFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'hall_id',
        'hall_type_id',
        'maximum_capacity',
    ];

    /**
     * Get the hall that owns the hall seat type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hall(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    /**
     * Get the seat type that owns the hall seat type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seatType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SeatType::class);
    }
}
