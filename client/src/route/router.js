import { createRouter, createWebHistory } from 'vue-router';

import About from '../pages/About.vue';
import Dashboard from '../pages/Dashboard.vue';
import Profile from '../pages/Profile.vue'
import Login from '../pages/Login.vue'
import AllProduct from '../pages/AllProduct.vue';
import AddProduct from '../pages/AddProduct.vue'
import ExpiredProduct from '../pages/ExpiredProduct.vue'
import LowStock from '../pages/LowStock.vue';
import Category from '../pages/Category.vue';
import AddCategory from '../pages/AddCategory.vue';
import Brand from '../pages/Brand.vue';
import AddBrand from '../pages/AddBrand.vue'

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


  {
    path: '/expired-product',
    component: ExpiredProduct
  },
 

  {
    path: '/low-stock',
    component: LowStock
  },

  {
    path: '/category-list',
    component: Category
  },

  {
    path: '/add-category',
    component: AddCategory
  },

  {
    path: '/brand-list',
    component: Brand
  },

  {
    path: '/add-brand',
    component: AddBrand
  },





];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;