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
        <router-link to="/">
          <h4 class="logo-text">Rukada</h4>
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

      <li>
        <router-link to="/all-product">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">
           
             All Product
          
           
          </div>
        </router-link>
      </li>

      <li>
        <router-link to="/add-product">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Create Product</div>
        </router-link>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Expired Product</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Low Stocks</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Category</div>
        </a>
      </li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Brands</div>
        </a>
      </li>

      <li class="menu-label">Sales</li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Sales</div>
        </a>
      </li>

       <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Sales Return</div>
        </a>
      </li>


      
       <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">POS</div>
        </a>
      </li>


       <li class="menu-label">Purchase</li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Purchase</div>
        </a>
      </li>

       <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Purchase Order</div>
        </a>
      </li>


      
       <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Purchase Return</div>
        </a>
      </li>

        <li class="menu-label">Finance & Accounts</li>

        
      <li :class="{ 'mm-active': visible }" @click="handleClick">
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="bx bx-home-alt"></i></div>
          <div class="menu-title">Expenses</div>
        </a>
        <ul :class="{ 'mm-collapse': true, 'mm-show': visible }">
          <li>
            <a href="index.html"><i class="bx bx-radio-circle"></i>Expenses</a>
          </li>
          <li>
            <a href="index2.html"
              ><i class="bx bx-radio-circle"></i>Expense Category</a
            >
          </li>
        
        </ul>
      </li>


       <li class="menu-label">Peoples</li>

      <li>
        <a href="widgets.html">
          <div class="parent-icon"><i class="bx bx-cookie"></i></div>
          <div class="menu-title">Customer</div>
        </a>
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