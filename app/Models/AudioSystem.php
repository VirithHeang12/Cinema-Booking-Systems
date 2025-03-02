<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AudioSystem extends Model
{
    /** @use HasFactory<\Database\Factories\AudioSystemFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
    ];

    // This Model will be removed soon. (reduce project scope)
}
