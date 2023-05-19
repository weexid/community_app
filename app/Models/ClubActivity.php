<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubActivity extends Model
{
    use HasFactory;

    protected $table = 'club_activities';

    protected $fillable = [
        'activity_name',
        'description',
        'slug',
        'thumbnail',
        'blob_id',
        'club_id',
        'views'
    ];
}
