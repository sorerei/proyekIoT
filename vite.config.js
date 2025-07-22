import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs'


export default defineConfig({
        server: {
        https: true,
        host: 'localhost', // Penting untuk bisa diakses via ngrok
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
    build: {
        chunkSizeWarningLimit: 1000, // dalam kB, misal 1000 kB
    },
});
