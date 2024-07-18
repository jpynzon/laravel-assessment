import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/main.vue';
import Login from './auth/login.vue';
import SignUp from './auth/signup.vue';
import Order from './components/order.vue';
import Contact from './components/contact.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/signup', component: SignUp },
    { path: '/login', component: Login },
    { path: '/order', component: Order },
    { path: '/contact', component: Contact },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
