import { createRouter, createWebHistory } from 'vue-router';
import Index from './components/Index.vue';
import Payments from './components/Payments.vue';
import Users from './components/Users.vue';

const routes = [
  {
    path: '/',
    component: Index
  },
  {
    path: '/payments',
    component: Payments
  },
  {
    path: '/users',
    component: Users
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;