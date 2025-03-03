<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScreenType extends Model
{
    /** @use HasFactory<\Database\Factories\ScreenTypeFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the shows for the screen.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shows(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Show::class);
    }
}
