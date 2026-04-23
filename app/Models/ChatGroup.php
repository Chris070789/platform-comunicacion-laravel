<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    protected $fillable = ['name', 'user_id'];
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
