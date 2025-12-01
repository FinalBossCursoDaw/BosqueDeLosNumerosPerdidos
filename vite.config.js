import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/menu-dropdown.css',
                'resources/js/app.js',
                'resources/js/juego-sumas.js',
                'resources/js/puente-logica.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
