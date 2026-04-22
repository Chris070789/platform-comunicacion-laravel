<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    public function chatGroup()
    {
        return $this->belongsTo(ChatGroup::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
