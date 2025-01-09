<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HallSeatType extends Model
{
    /** @use HasFactory<\Database\Factories\HallSeatTypeFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'hall_id',
        'hall_type_id',
        'maximum_capacity',
    ];
}
