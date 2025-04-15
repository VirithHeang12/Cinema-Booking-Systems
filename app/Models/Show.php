<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Show extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shows';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movie_subtitle_id',
        'hall_id',
        'screen_type_id',
        'show_time',
        'status',
        'movie_id',
    ];

    /**
     * Get the movie subtitle that owns the show.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movieSubtitle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MovieSubtitle::class);
    }

    /**
     * Get the hall that owns the show.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hall(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    /**
     * Get the screen type that owns the show.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function screenType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ScreenType::class);
    }

    /**
     * Get the show seats for the show.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function showSeats(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ShowSeat::class);
    }

/**
 * Get the movie associated with the show through the movie subtitle.
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
 */
public function movie(): HasOneThrough
{
    return $this->hasOneThrough(Movie::class, MovieSubtitle::class, 'id', 'id', 'movie_subtitle_id', 'movie_id');
}
}

