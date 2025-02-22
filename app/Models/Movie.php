<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'release_date',
        'duration',
        'rating',
        'trailer_url',
        'thumbnail_url',
        'production_company_id',
        'country_id',
        'classification_id',
        'language_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'release_date' => 'datetime',
    ];

    /**
     * Get the production company that owns the movie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productionCompany(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductionCompany::class);
    }

    /**
     * Get the country that owns the movie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the classification that owns the movie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classification(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Classification::class);
    }

    /**
     * Get the language that owns the movie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the movie genres.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movieGenres(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MovieGenre::class);
    }

    /**
     * Get the movie subtitles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movieSubtitles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MovieSubtitle::class);
    }
}
