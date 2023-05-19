<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubCarousel extends Model
{
    use HasFactory;

    protected $table = 'club_carousels';

    protected $fillable = [
        'media_src',
        'alt_name',
        'club_id'
    ];

}
