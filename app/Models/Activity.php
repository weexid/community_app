<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public $fillable = ['club_id', 'title', 'description', 'thumbnail', 'type', 'slug'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-M-Y');
    }

    public function club(){
        return $this->belongsTo(Club::class);
    }

    public function article() {
        return $this->hasMany(Article::class, 'activity_id');
    }

    public function video() {
        return $this->hasMany(Video::class, 'activity_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'activity_tags');
    }

}
