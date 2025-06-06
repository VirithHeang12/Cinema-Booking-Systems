<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hall extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'halls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hall_type_id',
        'name',
        'description',
        'maximum_seats_per_row',
    ];

    /**
     * Get the hall type that owns the hall.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hallType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HallType::class);
    }

    /**
     * Get the hall seat types for the hall.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hallSeatTypes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HallSeatType::class);
    }

    /**
     * Get the seats for the hall.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seats(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Seat::class);
    }

    /**
     * Get the shows for the hall.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shows(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Show::class);
    }
}
