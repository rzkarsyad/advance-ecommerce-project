<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name_en',
        'category_name_id',
        'category_slug_en',
        'category_slug_id',
        'category_icon',
    ];
    use HasFactory;
}
