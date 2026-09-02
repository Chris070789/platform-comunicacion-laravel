<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
     protected $fillable = ['title', 'description', 'user_id'];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
