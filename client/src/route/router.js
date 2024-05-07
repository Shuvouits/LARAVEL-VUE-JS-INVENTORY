import { createRouter, createWebHistory } from 'vue-router';
import store from '../store';

import About from '../pages/About.vue';
import Dashboard from '../pages/Dashboard.vue';
import Profile from '../pages/profile/Profile.vue'
import Login from '../pages/Login.vue'
import AllProduct from '../pages/AllProduct.vue';
import AddProduct from '../pages/AddProduct.vue'
import ExpiredProduct from '../pages/ExpiredProduct.vue'
import LowStock from '../pages/LowStock.vue';
import Category from '../pages/category/Category.vue';
import AddCategory from '../pages/category/AddCategory.vue';
import Brand from '../pages/Brand.vue';
import AddBrand from '../pages/AddBrand.vue'
import Sales from '../pages/Sales.vue'
import SalesReturn from '../pages/SalesReturn.vue'
import AddSales from '../pages/sale/AddSales.vue'
import AddSalesReturn from '../pages/sale/AddSalesReturn.vue'
import Purchase from '../pages/purchase/Purchase.vue'
import AddPurchase from '../pages/purchase/AddPurchase.vue'
import PurchasedOrder from '../pages/purchase/PurchasedOrder.vue'
import PurchaseReturn from '../pages/purchase/PurchaseReturn.vue'
import AddPurchasedReturn from '../pages/purchase/AddPurchasedReturn.vue'
import Expense from '../pages/expense/Expense.vue'
import AddExpense from '../pages/expense/AddExpense.vue'
import ExpenseCategory from '../pages/expense/ExpenseCategory.vue'
import AddCategoryExpense from '../pages/expense/AddCategoryExpense.vue'
import Setting from '../pages/profile/Setting.vue'
import Test from '../pages/profile/Test.vue'




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
    component: Dashboard,
    meta: { requiresAuth: true }
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

  {
    path: '/sales',
    component: Sales
  },

  {
    path: '/sales-return',
    component: SalesReturn
  },

  {
    path: '/add-sales',
    component: AddSales
  },

  {
    path: '/add-sales-return',
    component: AddSalesReturn
  },

  {
    path: '/purchase',
    component: Purchase
  },  


  
  {
    path: '/add-purchased',
    component: AddPurchase
  },

  {
    path: '/order-purchased',
    component: PurchasedOrder
  },

  {
    path: '/return-purchased',
    component: PurchaseReturn
  },

  {
    path: '/add-purchased-return',
    component: AddPurchasedReturn
  },

  {
    path: '/expense',
    component: Expense
  },

  {
    path: '/add-expense',
    component: AddExpense
  },

  {
    path: '/category-expense',
    component: ExpenseCategory
  },

  {
    path: '/add-category-expense',
    component: AddCategoryExpense
  },

  {
    path: '/setting',
    component: Setting
  },

  {
    path: '/test',
    component: Test
  },



];

const router = createRouter({
  history: createWebHistory(),
  routes
});


router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    // Check if token is present in Vuex store
    if (store.state.token) {
      next(); // Proceed to the route
    } else {
      // Redirect to login page
      next('/');
    }
  } else {
    next(); // Allow access to public routes
  }
});








export default router;