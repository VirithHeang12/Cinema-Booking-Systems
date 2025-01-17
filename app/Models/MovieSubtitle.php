<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovieSubtitle extends Model
{
    /** @use HasFactory<\Database\Factories\MovieSubtitleFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'movie_id',
        'language',
    ];
}
