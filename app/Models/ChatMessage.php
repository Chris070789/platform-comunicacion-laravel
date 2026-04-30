<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['chat_group_id', 'user_id', 'message'];

    public function chatGroup()
    {
        return $this->belongsTo(ChatGroup::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
