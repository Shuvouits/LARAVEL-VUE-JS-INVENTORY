import { createRouter, createWebHistory } from 'vue-router';

import About from '../pages/About.vue';
import Dashboard from '../pages/Dashboard.vue';
import Profile from '../pages/Profile.vue'
import Login from '../pages/Login.vue'
import AllProduct from '../pages/AllProduct.vue';
import AddProduct from '../pages/AddProduct.vue'

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

  {
    path: '/all-product',
    component: AllProduct
  },

  {
    path: '/add-product',
    component: AddProduct
  },
 




];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;