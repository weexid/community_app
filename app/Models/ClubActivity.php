<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubActivity extends Model
{
    use HasFactory;

    protected $table = 'club_activities';

    protected $fillable = [
        'title',
        'content',
        'slug',
        'image',
        'club_id',
        'views'
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}
