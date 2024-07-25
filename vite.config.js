import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/sidebar.js',
                'resources/css/usermanagement.css',
                'resources/css/sidebar.css',
                'resources/css/office.css',
                'resources/css/dashboard.css',
                'resources/css/qrpage.css'
            ],
            refresh: true,
        }),
    ],
});
