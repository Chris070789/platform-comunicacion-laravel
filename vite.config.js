import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({

    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css'],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
        manifest: true,
        emptyOutDir: true, // limpia antes de compilar
    },
    server: {
        host: '0.0.0.0', // Esto soluciona el error EADDRNOTAVAIL (escucha en todas partes)
        port: 5174,
        strictPort: true,
        cors: true,
        origin: 'https://chachara.tailb37c6d.ts.net:5174',
        hmr: {
            host: 'chachara.tailb37c6d.ts.net',
            protocol: 'wss',
            //host: 'localhost',
            //host: '100.95.224.90',
            port: 5174,
            //clientPort: 443,
            clientPort: 5174,
        },
    },
});
