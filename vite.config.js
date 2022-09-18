import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ['public/css/app.css', 'public/js/todo.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetsUrls: {
                    base: null,
                    includeAbsolute: false
                }
            }
        })
    ],
});
