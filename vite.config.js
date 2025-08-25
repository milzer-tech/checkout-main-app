import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/css/app.css',
                // 'resources/js/app.js',
                'resources/vendor/checkout/css/app.css',
                'resources/vendor/checkout/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
