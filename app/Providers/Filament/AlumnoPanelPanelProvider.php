<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Auth\Middleware\Authenticate as AuthMiddleware;
use Illuminate\Support\Facades\Auth;

class AlumnoPanelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('alumno-up')
            ->path('alumno-up')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/AlumnoPanel/Resources'), for: 'App\Filament\AlumnoPanel\Resources')
            ->discoverPages(in: app_path('Filament/AlumnoPanel/Pages'), for: 'App\Filament\AlumnoPanel\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/AlumnoPanel/Widgets'), for: 'App\Filament\AlumnoPanel\Widgets')
            ->widgets([
                AccountWidget::class,
                //FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            ->authMiddleware([
                AuthMiddleware::class . ':alumno',
            ]);
    }
    /* ------------------------------------------
       Visibilidad del panel completo
       ------------------------------------------ */
    public function canAccess(): bool
    {
         /** @var \App\Models\User $user */
        $user = Auth::user();
        return $user->hasRole('alumno');
    }
}
