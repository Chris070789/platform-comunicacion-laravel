<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
<<<<<<< HEAD
     protected $fillable = ['workshop_id', 'name', 'description', 'position', 'max_points'];

    public function workshop() {
        return $this->belongsTo(Workshop::class);
    }

    public function submissions() {
        return $this->hasMany(Submission::class);
    }
=======
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

    public function scopeOrdered($query)
    {
        return $query->orderBy('position');
    }
>>>>>>> 26e60e7a559b73994959483d3fcad613cbf57b43
}
