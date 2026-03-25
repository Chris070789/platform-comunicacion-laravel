<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="filament js-focus-visible" data-theme="{{ $theme ?? 'light' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    {{-- Tailwind + Filament colores --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Alpine (Filament ya lo registra) --}}
    @livewireStyles
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50 dark:bg-gray-900 filament-body">
    <div class="filament-main max-w-5xl mx-auto p-6">
        @yield('content')   {{-- cambia $slot por esto --}}
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>
