<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\Material;
use App\Models\Unidad;
use App\Policies\MaterialPolicy;
use App\Policies\UnidaDPolicy;
use App\Models\Workshop;
use App\Policies\WorkshopPolicy;
//use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Material::class => MaterialPolicy::class,
        Unidad::class => UnidadPolicy::class,
        \App\Models\Cronograma::class => \App\Policies\CronogramaPolicy::class,
        Workshop::class => WorkshopPolicy::class,
    ];




    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('app-layout', \Illuminate\View\Component::class, 'app-layout');
        // now Laravel will load resources/views/components/app-layout.blade.php
        // $this->registerPolicies(); // ← registra las políticas
    }


}
