<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class WorkshopChart extends Component
{
    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $series = Cache::remember(
            "ws.{$this->workshop->id}." . $user->id,
            30,
            fn() => $this->buildSeries()
        );

        return view('livewire.workshop-chart', compact('series'));
    }

    private function buildSeries(): array
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $stages = $this->workshop->stages()->orderBy('id')->get();
        $labels = $stages->pluck('name')->toArray();
        $points = $stages->map(
            fn($s) => $s->submissions()
                ->where('user_id', $user->id)
                ->sum('points_earned')
        )->toArray();

        // acumulado
        for ($i = 1; $i < count($points); $i++) {
            $points[$i] += $points[$i - 1];
        }

        return [
            'labels' => $labels,
            'data'   => $points,
            'max'    => $this->workshop->max_points
        ];
    }

    // recibir eventos (opcional)
    protected $listeners = ['echo:user.' . '{{ auth()->id() }}', 'StudentProgressed'];

    public function updateChart(array $data)
    {
        $this->series['data'] = $data;
        $this->dispatchBrowserEvent('update-chart', $data);
    }
}
