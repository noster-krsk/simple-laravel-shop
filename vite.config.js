import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import vuetify from 'vite-plugin-vuetify'; // ← ЭТОГО НЕ ХВАТАЕТ

export default defineConfig({
    server: {
    host: 'localhost', // вместо true
    port: 5173,
    strictPort: true,
    origin: 'http://localhost:5173',
    hmr: {
        host: 'localhost',
        port: 5173,
    },
},


    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    vuetify(), // ← вот это обязательно!
    ],
})
