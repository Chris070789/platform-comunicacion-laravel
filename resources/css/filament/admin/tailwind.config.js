import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],          // hereda todo el tema de Filament
    content:  [
        // TU código anterior
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',

        // Filament
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',

        // si usaste componentes propios en otra carpeta
        // './resources/views/components/**/*.blade.php',
    ],

    // (opcional) tus propios colores, fonts, etc.
    theme: {
        extend: {
            colors: {
                primary: '#0ea5e9',
                // ...
            },
        },
    },

    plugins: [
        // tus plugins viejos
        // require('@tailwindcss/forms'),
        // require('@tailwindcss/typography'),
    ],
}
