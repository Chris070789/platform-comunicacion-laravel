<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
