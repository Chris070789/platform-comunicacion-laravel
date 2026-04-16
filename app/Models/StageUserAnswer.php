<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StageUserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stage_id',
        'question_id',
        'option_id',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    // Relaciones útiles
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
