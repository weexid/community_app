<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $fillable = ['tag_name'];

    public function activities() {
        return $this->belongsToMany(Activity::class, 'activity_tags');
    }
}
