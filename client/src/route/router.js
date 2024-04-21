import { createRouter, createWebHistory } from 'vue-router';

import About from '../pages/About.vue';
import Dashboard from '../pages/Dashboard.vue';
import Profile from '../pages/Profile.vue'
import Login from '../pages/Login.vue'

const routes = [

  

  {
    path: '/profile',
    name: 'Profile',
    component: Profile
  },

  {
    path: '/',
    component: Login
  },

  {
    path: '/dashboard',
    
    component: Dashboard
  },
 




];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;