<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HallType extends Model
{
    /** @use HasFactory<\Database\Factories\HallTypeFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the halls for the hall type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function halls(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Hall::class);
    }
}
