<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = [
        'workshop_id',
        'name',
        'description',
        'position',
        'max_points',
        'pdf',
        'video'
    ];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('position');
    }

    public function answers()
    {
        return $this->belongsToMany(User::class, 'stage_user_answers')
            ->withPivot('completed');
    }

     /**
     * Define los casts para los atributos del modelo.
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'position' => 'integer',
            'max_points' => 'integer',
        ];
    }

}
