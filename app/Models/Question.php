<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['stage_id', 'content'];
    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
