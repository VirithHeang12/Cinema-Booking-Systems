<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SeatType extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seat_types';

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
        'name',
        'description',
        'price',
    ];

    /**
     * Get the seats for the seat type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seats(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Seat::class);
    }

    /**
     * Get the hall seat types for the seat type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hallSeatTypes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HallSeatType::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($seatType) {
            $seatType->id = (string) Str::uuid();
        });
    }
}
