import { createRouter, createWebHistory } from 'vue-router';
import store from '../store';

import About from '../pages/About.vue';
import Dashboard from '../pages/Dashboard.vue';
import Profile from '../pages/profile/Profile.vue'
import Login from '../pages/Login.vue'
import AllProduct from '../pages/product/AllProduct.vue';
import AddProduct from '../pages/product/AddProduct.vue'
import ExpiredProduct from '../pages/product/ExpiredProduct.vue'
import LowStock from '../pages/product/LowStock.vue';
import Category from '../pages/category/Category.vue';
import AddCategory from '../pages/category/AddCategory.vue';
import AddBrand from '../pages/brand/AddBrand.vue'
import Sales from '../pages/sale/Sales.vue'
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
import EditCategory from '../pages/category/EditCategory.vue'
import Testing from '../pages/category/Testing.vue';
import BrandList from '../pages/brand/BrandList.vue';
import EditBrand from '../pages/brand/EditBrand.vue';
import EditProduct from '../pages/product/EditProduct.vue';
import Customer from '../pages/customer/Customer.vue';
import AddCustomer from '../pages/customer/AddCustomer.vue'
import Supplier from '../pages/supplier/Supplier.vue';
import AddSupplier from "../pages/supplier/AddSupplier.vue";
import EditSupplier from '../pages/supplier/EditSupplier.vue'
import EditCustomer from '../pages/customer/EditCustomer.vue';
import EditCategoryExpense from '../pages/expense/EditCategoryExpense.vue';
import EditExpense from "../pages/expense/EditExpense.vue";
import EditPurchase from '../pages/purchase/EditPurchase.vue';
import EditSales from '../pages/sale/EditSales.vue';




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
    component: AllProduct,
    meta: { requiresAuth: true }
  },

  {
    path: '/add-product',
    component: AddProduct,
    meta: { requiresAuth: true }
  },

  {
    path: '/product/edit/:id',
    component: EditProduct,
    meta: { requiresAuth: true }
  },


  {
    path: '/expired-product',
    component: ExpiredProduct,
    meta: { requiresAuth: true }
  },
 

  {
    path: '/low-stock',
    component: LowStock,
    meta: { requiresAuth: true }
  },

  {
    path: '/category-list',
    component: Category,
    meta: { requiresAuth: true }
  },

  {
    path: '/add-category',
    component: AddCategory,
    meta: { requiresAuth: true }
  },

  {
    path: '/category/edit/:id',
    component: EditCategory,
    meta: { requiresAuth: true }
  },

  {
    path: '/brand-list',
    component: BrandList,
    meta: { requiresAuth: true }
  },

  {
    path: '/add-brand',
    component: AddBrand,
    meta: { requiresAuth: true }
  },  

  {
    path: '/brand/edit/:id',
    component: EditBrand,
    meta: { requiresAuth: true }
  },

  {
    path: '/sales',
    component: Sales,
    meta: { requiresAuth: true }
  },

  {
    path: '/sales/edit/:id',
    component: EditSales,
    meta: { requiresAuth: true }
  },

  {
    path: '/sales-return',
    component: SalesReturn,
    meta: { requiresAuth: true }
  },

  {
    path: '/add-sales',
    component: AddSales,
    meta: { requiresAuth: true }
  },

  {
    path: '/add-sales-return',
    component: AddSalesReturn,
    meta: { requiresAuth: true }
  },

  {
    path: '/purchase',
    component: Purchase,
    meta: { requiresAuth: true }
  },  


  
  {
    path: '/add-purchased',
    component: AddPurchase,
    meta: { requiresAuth: true }
  },

  {
    path: '/order-purchased',
    component: PurchasedOrder,
    meta: { requiresAuth: true }
  },

  {
    path: '/return-purchased',
    component: PurchaseReturn,
    meta: { requiresAuth: true }
  },

  {
    path: '/purchase/edit/:id',
    component: EditPurchase,
    meta: { requiresAuth: true }
  },

  {
    path: '/add-purchased-return',
    component: AddPurchasedReturn,
    meta: { requiresAuth: true }
  },

  {
    path: '/expense',
    component: Expense,
    meta: { requiresAuth: true }
  },

  {
    path: '/add-expense',
    component: AddExpense,
    meta: { requiresAuth: true }
  },

  {
    path: '/expense-category',
    component: ExpenseCategory,
    meta: { requiresAuth: true }
  },

  {
    path: '/add-category-expense',
    component: AddCategoryExpense,
    meta: { requiresAuth: true }
  },

  {
    path: '/expense/category/edit/:id',
    component: EditCategoryExpense,
    meta: { requiresAuth: true }
  },

  {
    path: '/expense/edit/:id',
    component: EditExpense,
    meta: { requiresAuth: true }
  },

  {
    path: '/setting',
    component: Setting,
    meta: { requiresAuth: true }
  },

  {
    path: '/testing',
    component : Testing,
    meta: { requiresAuth: true }
  },

  {
    path: '/customer',
    component : Customer,
    meta: { requiresAuth: true }
  },

  {
    path: '/add-customer',
    component : AddCustomer,
    meta: { requiresAuth: true }
  },

  {
    path: '/customer/edit/:id',
    component: EditCustomer,
    meta: { requiresAuth: true }
  },


  {
    path: '/supplier',
    component : Supplier,
    meta: { requiresAuth: true }
  },

  {
    path: '/add-supplier',
    component : AddSupplier,
    meta: { requiresAuth: true }
  },

  {
    path: '/supplier/edit/:id',
    component: EditSupplier,
    meta: { requiresAuth: true }
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