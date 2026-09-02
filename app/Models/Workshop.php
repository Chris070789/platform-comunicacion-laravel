<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable = ['title', 'docente_id', 'max_points'];
    public function teacher()
    {
        return $this->belongsTo(User::class);
    }
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'workshop_user')->withTimestamps();
    }
    public function answers()
    {
        return $this->hasMany(StageUserAnswer::class);
    }
}
