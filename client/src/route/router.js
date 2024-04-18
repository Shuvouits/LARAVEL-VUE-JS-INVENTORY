import { createRouter, createWebHistory } from 'vue-router';

import About from '../pages/About.vue';
import Dashboard from '../pages/Dashboard.vue';
import Profile from '../pages/Profile.vue'

const routes = [
  {
    path: '/profile',
    name: 'Profile',
    component: Profile
  },
  {
    path: '/about',
    name: 'About',
    component: About
  },

  {
    path: '/',
    name: 'Dashboard',
    component: Dashboard
  }


];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;