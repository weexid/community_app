<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityTag extends Model
{
    use HasFactory;

    public $fillable = ['activity_id', 'tag_id'];


    // public function tag() {
    //     return $this->belongsTo(Tag::class, 'tag_id', 'id');
    // }

    // public function activity() {
    //     return $this->hasMany(Activity::class);
    // }
}
