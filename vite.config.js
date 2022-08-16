import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/css/header.css',
            'resources/css/main.css',
            'resources/css/footer.css',
        ]),
    ],
});
