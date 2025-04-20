<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HallSeatType extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hall_seat_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hall_id',
        'seat_type_id',
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
