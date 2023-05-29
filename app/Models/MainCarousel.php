<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCarousel extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'image_url',
        'heading',
        'sub_heading',
        'cta_text', 
        'cta_link',
    ];
}
