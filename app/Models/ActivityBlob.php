<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityBlob extends Model
{
    use HasFactory;

    protected $table = 'activity_blobs';

    protected $fillable = [ 
        'media_src',
        'alt_name',
        'activity_id',
        'media_type',
    ];
}
