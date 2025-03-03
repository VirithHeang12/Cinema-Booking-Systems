<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodAndBeverage extends Model
{
    /** @use HasFactory<\Database\Factories\FoodAndBeverageFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'image', 'price'];

    // This Model will be removed soon. (reduce project scope)

}
