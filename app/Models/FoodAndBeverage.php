<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodAndBeverage extends Model
{
    /** @use HasFactory<\Database\Factories\FoodAndBeverageFactory> */
    use HasFactory;
    protected $fillable = ['name', 'image', 'price'];
}
