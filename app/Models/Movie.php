<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'description','release_date','duration','rating','trailer_url','thumbnail','genre_id','production_company_id','country_id','classification_id'];
}
