import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
        server: {
        host: '0.0.0.0', // Penting untuk bisa diakses via ngrok
        port: 5173       // Port default Vite
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
