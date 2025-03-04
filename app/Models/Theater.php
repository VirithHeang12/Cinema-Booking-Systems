<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    /** @use HasFactory<\Database\Factories\TheaterFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * Get the halls for the theater.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function halls(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Hall::class);
    }

}
