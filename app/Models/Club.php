<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $table = 'clubs';

    protected $fillable = ['club_title', 'club_tagline', 'description', 'slug', 'image', 'image_url'];

    public function activities(){
        return $this->hasMany(ClubActivity::class, 'club_id');
    }
}