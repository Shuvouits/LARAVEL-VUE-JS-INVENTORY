<script>
export default {
  data() {
    return {
      visible: false, // Initial state value
      salesVisible: false,
      pvisible: false,
      evisible: false,
      cvisible: false,
      rvisible: false,
    };
  },

  props: {
    handleSidebar: {
      type: String,
      required: true
    },
  },
  

  methods: {
    handleClick() {
      this.visible = !this.visible; // Toggle the state value
      console.log(this.visible);
    },

    handleSales() {
      this.salesVisible = !this.salesVisible; // Toggle the state value
    },

    handlePurchased() {
      this.pvisible = !this.pvisible; // Toggle the state value
    },

    handleExpense() {
      this.evisible = !this.evisible; // Toggle the state value
    },

    handlePeople() {
      this.cvisible = !this.cvisible; // Toggle the state value
    },

    handleReport() {
      this.rvisible = !this.rvisible; // Toggle the state value
    },

    scrollToSection(sectionId) {
      // Scroll to the section with the given id
      const element = document.getElementById(sectionId);
      if (element) {
        element.scrollIntoView({ behavior: "smooth" });
      }
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
      <div class="toggle-icon ms-auto" @click="handleSidebar"><i class="bx bx-arrow-back"></i></div>
    </div>

    <!--navigation-->
    <ul :class="{ metismenu: true, 'mm-show': visible }" id="menu">
      <li>
        <router-link to="/dashboard">
          <div class="parent-icon"><i class="bx bx-category"></i></div>
          <div class="menu-title">Dashboard</div>
        </router-link>
      </li>

      <li class="menu-label">Managed Products</li>

      <li
        :class="{
          'mm-active':
            visible ||
            $route.path === '/all-product' ||
            $route.path === '/add-product' ||
            $route.path === '/expired-product' ||
            $route.path === '/low-stock' ||
            $route.path === '/category-list' ||
            $route.path === '/brand-list' ||
            this.$route.path.startsWith('/product/'),
        }"
        @click="handleClick"
      >
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="bx bx-camera-home"></i></div>
          <div class="menu-title">Products</div>
        </a>
        <ul
          :class="{
            'mm-collapse': true,
            'mm-show':
              visible ||
              $route.path === '/all-product' ||
              $route.path === '/add-product' ||
              $route.path === '/expired-product' ||
              $route.path === '/low-stock' ||
              $route.path === '/category-list' ||
              $route.path === '/brand-list' ||
              this.$route.path.startsWith('/product/'),
          }"
        >
          <li
            :class="{
              'mm-active':
                $route.path === '/all-product' ||
                this.$route.path.startsWith('/product/'),
            }"
          >
            <router-link to="/all-product"
              ><i class="bx bx-health"></i>All-Product</router-link
            >
          </li>

          <li
            :class="{
              'mm-active': $route.path === '/add-product',
            }"
          >
            <router-link to="/add-product"
              ><i class="bx bx-ruble"></i>Create Product</router-link
            >
          </li>

          <li
            :class="{
              'mm-active': $route.path === '/expired-product',
            }"
          >
            <router-link to="/expired-product"
              ><i class="bx bx-bolt-circle"></i>Expired Product</router-link
            >
          </li>

          <li
            :class="{
              'mm-active': $route.path === '/low-stock',
            }"
          >
            <router-link to="/low-stock"
              ><i class="bx bx-first-page"></i>Low Stocks</router-link
            >
          </li>

          <li
            :class="{
              'mm-active':
                $route.path === '/category-list' ||
                $route.path === '/add-category' ||
                this.$route.path.startsWith('/category/'),
            }"
          >
            <router-link to="/category-list"
              ><i class="bx bx-play-circle"></i>Category</router-link
            >
          </li>

          <li
            :class="{
              'mm-active':
                $route.path === '/brand-list' ||
                $route.path === '/add-brand' ||
                this.$route.path.startsWith('/brand/'),
            }"
          >
            <router-link to="/brand-list"
              ><i class="bx bx-sync"></i>Brand</router-link
            >
          </li>
        </ul>
      </li>

      <li class="menu-label">Managed Sales</li>

      <li
        :class="{
          'mm-active':
            salesvisible ||
            $route.path === '/sales' ||
            $route.path === '/add-sales' ||
            this.$route.path.startsWith('/sales/'),
        }"
        @click="handleSales"
      >
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="bx bx-book-add"></i></div>
          <div class="menu-title">Managed Sales</div>
        </a>
        <ul
          :class="{
            'mm-collapse': true,
            'mm-show':
              salesVisible ||
              $route.path === '/sales' ||
              $route.path === '/add-sales' ||
              $route.path === '/sales-return' ||
              this.$route.path.startsWith('/sales/'),
          }"
        >
          <li
            :class="{
              'mm-active':
                $route.path === '/sales' ||
                $route.path === '/add-sales' ||
                this.$route.path.startsWith('/sales/'),
            }"
          >
            <router-link to="/sales"
              ><i class="bx bx-message-x"></i>Sales</router-link
            >
          </li>
          <li
            :class="{
              'mm-active': $route.path === '/sales-return',
            }"
          >
            <router-link to="/sales-return"
              ><i class="bx bx-atom"></i>Sales Return</router-link
            >
          </li>
        </ul>
      </li>

      <li class="menu-label">Managed Purchased</li>

      <li
        :class="{
          'mm-active':
            pvisible ||
            $route.path === '/purchase' ||
            $route.path === '/add-purchased' ||
            $route.path === '/order-purchased' ||
            $route.path === '/received-purchased' ||
            $route.path === '/return-purchased' ||
            this.$route.path.startsWith('/purchase/'),
        }"
        @click="handlePurchased"
      >
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="bx bx-list-check"></i></div>
          <div class="menu-title">Purchase</div>
        </a>
        <ul
          :class="{
            'mm-collapse': true,
            'mm-show':
              pvisible ||
              $route.path === '/purchase' ||
              $route.path === '/add-purchased' ||
              $route.path === '/order-purchased' ||
              $route.path === '/return-purchased' ||
              this.$route.path.startsWith('/purchase/'),
          }"
        >
          <li
            :class="{
              'mm-active':
                $route.path === '/purchase' ||
                $route.path === '/add-purchased' ||
                this.$route.path.startsWith('/purchase/'),
            }"
          >
            <router-link to="/purchase"
              ><i class="bx bx-message-x"></i>Purchase</router-link
            >
          </li>

          <li
            :class="{
              'mm-active': $route.path === '/order-purchased',
            }"
          >
            <router-link to="/order-purchased"
              ><i class="bx bx-atom"></i>Purchase Order</router-link
            >
          </li>

          <li
            :class="{
              'mm-active': $route.path === '/received-purchased',
            }"
          >
            <router-link to="/received-purchased"
              ><i class="bx bx-atom"></i>Purchase Received</router-link
            >
          </li>

          <li
            :class="{
              'mm-active': $route.path === '/return-purchased',
            }"
          >
            <router-link to="/return-purchased"
              ><i class="bx bx-atom"></i>Purchase Return</router-link
            >
          </li>
        </ul>
      </li>

      <li class="menu-label">Finance & Accounts</li>

      <li
        :class="{
          'mm-active':
            evisible ||
            $route.path === '/expense-category' ||
            $route.path === '/add-expense' ||
            $route.path === '/expense' ||
            this.$route.path.startsWith('/expense/'),
        }"
        @click="handleExpense"
      >
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="bx bx-cut"></i></div>
          <div class="menu-title">Expenses</div>
        </a>
        <ul
          :class="{
            'mm-collapse': true,
            'mm-show':
              evisible ||
              $route.path === '/expense-category' ||
              $route.path === '/add-expense' ||
              $route.path === '/expense' ||
              this.$route.path.startsWith('/expense/'),
          }"
        >
          <li
            :class="{
              'mm-active':
                $route.path === '/expense' || $route.path === '/add-expense',
            }"
          >
            <router-link to="/expense"
              ><i class="bx bx-radio-circle"></i>Expenses</router-link
            >
          </li>
          <li
            :class="{
              'mm-active':
                $route.path === '/expense-category' ||
                $route.path === '/add-category-expense' ||
                this.$route.path.startsWith('/expense/category/'),
            }"
          >
            <router-link to="/expense-category"
              ><i class="bx bx-radio-circle"></i>Expense Category</router-link
            >
          </li>
        </ul>
      </li>

      <li class="menu-label">Managed Peoples</li>

      <li
        :class="{
          'mm-active':
            cvisible ||
            $route.path === '/customer' ||
            $route.path === '/add-customer' ||
            $route.path === '/supplier' ||
            $route.path === '/add-supplier' ||
            this.$route.path.startsWith('/customer/') || 
            this.$route.path.startsWith('/supplier/'),
        }"
        @click="handlePeople"
      >
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="bx bx-detail"></i></div>
          <div class="menu-title">People</div>
        </a>
        <ul
          :class="{
            'mm-collapse': true,
            'mm-show':
              cvisible ||
              $route.path === '/customer' ||
              $route.path === '/add-customer' ||
              $route.path === '/supplier' ||
              $route.path === '/add-supplier' ||
              this.$route.path.startsWith('/customer/') ||
              this.$route.path.startsWith('/supplier/') 
          }"
        >
          <li
            :class="{
              'mm-active':
                $route.path === '/customer' || $route.path === '/add-customer' || this.$route.path.startsWith('/customer/'),
            }"
          >
            <router-link to="/customer"
              ><i class="bx bx-radio-circle"></i>All-Customer</router-link
            >
          </li>
          <li
            :class="{
              'mm-active':
                $route.path === '/supplier' ||
                $route.path === '/add-supplier' ||
                this.$route.path.startsWith('/supplier/'),
            }"
          >
            <router-link to="/supplier"
              ><i class="bx bx-radio-circle"></i>All Supplier</router-link
            >
          </li>
        </ul>
      </li>

      

     

      <li class="menu-label">Managed Reports</li>

      <li
        :class="{
          'mm-active':
            rvisible ||
            $route.path === '/sales-report' ||
            $route.path === '/purchase-report' ||
            $route.path === '/expense-report' ||
            $route.path === '/profit-loss-report',
           
        }"
        @click="handleReport"
      >
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="bx bx-cube"></i></div>
          <div class="menu-title">All Reports</div>
        </a>
        <ul
          :class="{
            'mm-collapse': true,
            'mm-show':
              rvisible ||
              $route.path === '/sales-report' ||
              $route.path === '/purchase-report' ||
              $route.path === '/expense-report' ||
              $route.path === '/profit-loss-report' ||
              this.$route.path.startsWith('/customer/') ||
              this.$route.path.startsWith('/supplier/') 
          }"
        >
          <li
            :class="{
              'mm-active':
                $route.path === '/sales-report' ,
            }"
          >
            <router-link to="/sales-report"
              ><i class="bx bx-radio-circle"></i>Sales Report</router-link
            >
          </li>
          <li
            :class="{
              'mm-active':
                $route.path === '/purchase-report',
            }"
          >
            <router-link to="/purchase-report"
              ><i class="bx bx-radio-circle"></i>Purchase Report</router-link
            >
          </li>

          <li
            :class="{
              'mm-active':
                $route.path === '/expense-report',
            }"
          >
            <router-link to="/expense-report"
              ><i class="bx bx-radio-circle"></i>Expense Report</router-link
            >
          </li>

          <li
            :class="{
              'mm-active':
                $route.path === '/profit-loss-report',
            }"
          >
            <router-link to="/profit-loss-report"
              ><i class="bx bx-radio-circle"></i>Profit & Loss</router-link
            >
          </li>


        </ul>
      </li>



     

     

      
    </ul>
    <!--end navigation-->
  </div>
</template>
