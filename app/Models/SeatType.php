<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatType extends Model
{
    /** @use HasFactory<\Database\Factories\SeatTypeFactory> */
    use HasFactory;
    use SoftDeletes;
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
}
