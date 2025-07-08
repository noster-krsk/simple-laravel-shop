import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import vuetify from 'vite-plugin-vuetify';

export default defineConfig({
<<<<<<< HEAD
=======
    base: '/build/',
>>>>>>> ffc4c3d (Добавление тестового api/prices)
    plugins: [

        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
        vuetify(),
    ],
});
