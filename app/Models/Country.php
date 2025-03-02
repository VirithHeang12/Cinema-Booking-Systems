<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name'];

    /**
     * Get the movies for the country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Movie::class);
    }
}
