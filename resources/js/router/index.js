import { createRouter, createWebHistory } from 'vue-router';

// Импорт Vue-компонентов, которые соответствуют страницам
import Home from '../views/Home.vue';
import Add from '../views/Add.vue';
import Cart from '../views/Cart.vue';
import Products from '../views/products.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/add',
        name: 'add',
        component: Add,
    },
    {
        path: '/cart',
        name: 'cart',
        component: Cart,
    },
    {
        path: '/products',
        name: 'products',
        component: Products,
    },
    // Можно добавлять больше маршрутов:
    // {
    //   path: '/tasks',
    //   name: 'tasks',
    //   component: Tasks,
    // }
];

const router = createRouter({
    history: createWebHistory(), // чтобы работать с Laravel без # в URL
    routes,
});

export default router;
