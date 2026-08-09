import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/script.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Для локальной разработки
        port: 5173,
        cors: {
            origin: 'https://avmagro.com.ua', // Разрешаем запросы с этого домена
            methods: ['GET', 'POST'], // Разрешённые методы
            allowedHeaders: ['Content-Type', 'Authorization'], // Разрешённые заголовки
            credentials: true, // Если нужны куки или авторизация
        },
    },
    build: {
        outDir: 'public/build', // Убедитесь, что сборка идёт в правильную папку
    },
});
