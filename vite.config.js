import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/vendor/checkout/css/app.css',
                'resources/vendor/checkout/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
