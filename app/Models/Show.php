<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Show extends Model
{
    /** @use HasFactory<\Database\Factories\ShowFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'movie_subtitle_id',
        'hall_id',
        'screen_type_id',
        'show_time',
        'status',
    ];
}
