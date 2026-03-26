<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
     protected $fillable = ['workshop_id', 'name', 'description', 'position', 'max_points'];

    public function workshop() {
        return $this->belongsTo(Workshop::class);
    }

    public function submissions() {
        return $this->hasMany(Submission::class);
    }
}
