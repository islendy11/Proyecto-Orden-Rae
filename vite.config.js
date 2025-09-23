import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                'resources/views/**/*.blade.php',
                'resources/js/**/*.js',
                'app/Http/Livewire/**/*.php',
                'app/View/Components/**/*.php',
                'lang/**/*.php',
                'routes/**/*.php',
            ],
        }),
    ],
});