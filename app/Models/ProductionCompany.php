<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionCompany extends Model
{
    /** @use HasFactory<\Database\Factories\ProductionCompanyFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'description'];
}
