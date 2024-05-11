<script>
export default {
  data() {
    return {
      visible: false, // Initial state value
    };
  },

  methods: {
    handleClick() {
      this.visible = !this.visible; // Toggle the state value
      console.log(this.visible);
    },
  },
};
</script>

<template>
  <div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
      <div>
        <img
          src="../../assets/images/logo-icon.png"
          class="logo-icon"
          alt="logo icon"
        />
      </div>
      <div>
        <router-link to="/dashboard">
          <h4 class="logo-text">Bike-Buzz</h4>
        </router-link>
      </div>
      <div class="toggle-icon ms-auto"><i class="bx bx-arrow-back"></i></div>
    </div>
    <!--navigation-->
    <ul :class="{ metismenu: true, 'mm-show': visible }" id="menu">
      <li>
        <router-link to="/dashboard">
          <div class="parent-icon"><i class="bx bx-category"></i></div>
          <div class="menu-title">Dashboard</div>
        </router-link>
      </li>

      <li class="menu-label">Inventory</li>

      <li :class="{
          'mm-active':
            $route.path === '/all-product' ||
            this.$route.path.startsWith('/product/'),
        }">
        <router-link to="/all-product">
          <div class="parent-icon"><i class="bx bx-health"></i></div>
          <div class="menu-title">Products</div>
        </router-link>
      </li>

      <li :class="{
          'mm-active':
            $route.path === '/add-product'
        }">
        <router-link to="/add-product">
          <div class="parent-icon"><i class="bx bx-ruble"></i></div>
          <div class="menu-title">Create Product</div>
        </router-link>
      </li>

      <li :class="{
          'mm-active':
            $route.path === '/expired-product'
        }">
        <router-link to="/expired-product">
          <div class="parent-icon"><i class="bx bx-bolt-circle"></i></div>
          <div class="menu-title">Expired Product</div>
        </router-link>
      </li>

      <li>
        <router-link to="/low-stock">
          <div class="parent-icon"><i class="bx bx-first-page"></i></div>
          <div class="menu-title">Low Stocks</div>
        </router-link>
      </li>

      <li
        :class="{
          'mm-active':
            $route.path === '/category-list' ||
            $route.path === '/add-category' ||
            this.$route.path.startsWith('/category/'),
        }"
      >
        <router-link to="/category-list">
          <div class="parent-icon"><i class="bx bx-play-circle"></i></div>
          <div class="menu-title">Category</div>
        </router-link>
      </li>

      <li :class="{
          'mm-active':
            $route.path === '/brand-list' ||
            $route.path === '/add-brand' ||
            this.$route.path.startsWith('/brand/'),
        }">
        <router-link to="/brand-list">
          <div class="parent-icon"><i class="bx bx-sync"></i></div>
          <div class="menu-title">Brands</div>
        </router-link>
      </li>

      <li class="menu-label">Sales</li>

      <li>
        <router-link to="/sales">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Sales</div>
        </router-link>
      </li>

      <li>
        <router-link to="sales-return">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Sales Return</div>
        </router-link>
      </li>

      <li class="menu-label">Purchase</li>

      <li>
        <router-link to="/purchase">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Purchase</div>
        </router-link>
      </li>

      <li>
        <router-link to="/order-purchased">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Purchase Order</div>
        </router-link>
      </li>

      <li>
        <router-link to="/return-purchased">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Purchase Return</div>
        </router-link>
      </li>

      <li class="menu-label">Finance & Accounts</li>

      <li :class="{ 'mm-active': visible }" @click="handleClick">
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="bx bx-home-alt"></i></div>
          <div class="menu-title">Expenses</div>
        </a>
        <ul :class="{ 'mm-collapse': true, 'mm-show': visible }">
          <li>
            <router-link to="/expense"
              ><i class="bx bx-radio-circle"></i>Expenses</router-link
            >
          </li>
          <li>
            <router-link to="/category-expense"
              ><i class="bx bx-radio-circle"></i>Expense Category</router-link
            >
          </li>
        </ul>
      </li>

      <li class="menu-label">Peoples</li>

      <li  :class="{
          'mm-active':
            $route.path === '/customer'
        }">
        <router-link to="/customer">
          <div class="parent-icon"><i class="bx bx-analyse"></i></div>
          <div class="menu-title">Customer</div>
        </router-link>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Suppliers</div>
        </a>
      </li>

      <li class="menu-label">Reports</li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Sales Report</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Purchase Reports</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Inventory Reports</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Invoice Reports</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Supplier Reports</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Customer Reports</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Expense Reports</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Income Reports</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Profit & Loss</div>
        </a>
      </li>
    </ul>
    <!--end navigation-->
  </div>
</template>