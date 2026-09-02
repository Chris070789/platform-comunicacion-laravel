<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
     protected $fillable = ['stage_id', 'user_id', 'content', 'points_earned', 'completed', 'completed_at'];

    public function stage() {
        return $this->belongsTo(Stage::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
