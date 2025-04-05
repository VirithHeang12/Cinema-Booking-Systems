import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vuePlugin from '@vitejs/plugin-vue';
import vuetify from 'vite-plugin-vuetify';

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vuePlugin(),
        vuetify({
            autoImport: true,
        }),
    ],
    server: {
        cors: true, // Enables CORS
        host: "localhost", // Ensures the dev server is accessible on localhost
        port: 5173, // Ensure the correct port for the Vite dev server
        headers: {
            "Access-Control-Allow-Origin": "*", // Allow requests from any origin (use specific origin in production)
        },
    },
});
