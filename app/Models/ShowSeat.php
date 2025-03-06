<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ShowSeat extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'show_seats';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($showSeat) {
            $showSeat->id = Str::uuid();
        });
    }
}
