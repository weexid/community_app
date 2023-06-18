<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubCarousel extends Model
{
    use HasFactory;

    protected $table = 'club_carousels';

    protected $fillable = [
        'image',
        'image_url',
        'heading',
        'sub_heading',
        'cta_text',
        'cta_link',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

}
