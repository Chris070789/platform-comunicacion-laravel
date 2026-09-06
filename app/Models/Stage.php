<?php

namespace App\Models;

use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;



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

    public function scopeOrdered(Builder $query)
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
    public function getProgressForUser(int $userId)
    {
        $totalQuestions = $this->questions()->count();

        if ($totalQuestions === 0) return 0;

        $answeredQuestions = \App\Models\StageUserAnswer::where('user_id', $userId)
            ->where('stage_id', $this->id)
            ->count();

        return round(($answeredQuestions / $totalQuestions) * 100);
    }

    // Relación con las respuestas guardadas
    public function userAnswers(): HasMany
    {
        return $this->hasMany(StageUserAnswer::class);
    }

    // Accessor para saber si está completado
    public function getIsCompletedAttribute(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return $this->userAnswers()
            ->where('user_id', Auth::id())
            ->where('completed', true)
            ->exists();
    }
}
