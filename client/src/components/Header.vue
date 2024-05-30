<script>

export default {
  data() {
    return {
      out_of_stock: this.$store.state.out_of_stock,
      top_customer: this.$store.state.top_customer,
      theme: localStorage.getItem("theme"),
    };
  },

  props: {
    handleSidebar: {
      type: String,
      required: true,
    },
  },

  methods: {

   

    handleTheme() {
      this.theme = "dark-theme";
      localStorage.setItem("theme", this.theme);
      document.documentElement.className = this.theme;
    },

    handleThemeLight() {
      this.theme = "light";
      localStorage.setItem("theme", this.theme);
      document.documentElement.className = this.theme;
    },

  

    

    created() {
      this.theme = localStorage.getItem("theme") || ""; // Set initial theme from localStorage
      document.documentElement.className = this.theme; // Apply initial theme class to <html> element
    },

    logout() {
      // Remove token from local storage
      localStorage.removeItem("token");
      localStorage.removeItem("phone");
      localStorage.removeItem("email");

      localStorage.removeItem("address");
      localStorage.removeItem("avatar");
      localStorage.removeItem("name");
      localStorage.removeItem("theme");
      localStorage.removeItem("out_of_stock");
      localStorage.removeItem("top_customer");

      // Optionally, you can also clear the token from Vuex store if you're using it
      this.$store.commit("CLEAR_TOKEN"); // Assuming you have a mutation named 'CLEAR_TOKEN'
      // Redirect the user to the login page or any other appropriate route
      // this.$router.push("/");
      window.location.reload("/");
    },
  },
};
</script>

<template>
  <header>
    <div class="topbar d-flex align-items-center">
      <nav class="navbar navbar-expand gap-3">
        <div class="mobile-toggle-menu" @click="handleSidebar">
          <i class="bx bx-menu"></i>
        </div>

        <div
          class="custom-link"
          style="display: flex; flex-wrap: wrap; gap: 20px"
        >
          <router-link to="/all-product">Product</router-link>
          <router-link to="/sales">Sales</router-link>
          <router-link to="/purchase">Purchase</router-link>
          <router-link to="/expense">Expense</router-link>
          <router-link to="/customer">Customer</router-link>
          <router-link to="/supplier">Supplier</router-link>
          <router-link to="/sales-report">Sales Report</router-link>
          <router-link to="/purchase-report">Purchase Report</router-link>
          <router-link to="/expense-report">Expense Report</router-link>
          <router-link to="/profit-loss-report">Profit Loss Report</router-link>
        </div>

        <div class="top-menu ms-auto">
          <ul class="navbar-nav align-items-center gap-1">
            <li
              class="nav-item mobile-search-icon d-flex d-lg-none"
              data-bs-toggle="modal"
              data-bs-target="#SearchModal"
            >
              <a class="nav-link" href="avascript:;"
                ><i class="bx bx-search"></i>
              </a>
            </li>

            <li
              v-if="theme === 'semi-dark' || theme === 'light'"
              class="nav-item dark-mode d-none d-sm-flex"
            >
              <a
                class="nav-link dark-mode-icon"
                @click="handleTheme"
                href="javascript:;"
                ><i class="bx bx-moon"></i>
              </a>
            </li>

            <li v-else class="nav-item dark-mode d-none d-sm-flex">
              <a
                class="nav-link dark-mode-icon"
                @click="handleThemeLight"
                href="javascript:;"
                ><i class="bx bx-sun"></i>
              </a>
            </li>

            <li class="nav-item dropdown dropdown-large">
              <a
                class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                href="#"
                data-bs-toggle="dropdown"
                >
                <i class="bx bx-bell"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a href="javascript:;">
                  <div class="msg-header">
                    <p class="msg-header-title">Stock Out Product</p>
                
                  </div>
                </a>

                <div class="header-notifications-list">
                  <a
                    v-for="(item, index) in this.out_of_stock"
                    :key="index"
                    class="dropdown-item"
                    href="javascript:;"
                  >
                  
                    <div class="d-flex align-items-center">
                      <div class="">
                       
                        <img
                          v-if="item.avatar"
                          :src="'https://appinventory.shuvobhowmik.xyz/images/' + item.avatar"
                          style="width: 40px; height: 40px; border-radius: 5px; "
                        />

                        <span v-else>
                          <svg
                            height="40"
                            viewBox="0 0 32 32"
                            width="40"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="m30 3.4141-1.4141-1.4141-26.5859 26.5859 1.4141 1.4141 2-2h20.5859a2.0027 2.0027 0 0 0 2-2v-20.5859zm-4 22.5859h-18.5859l7.7929-7.793 2.3788 2.3787a2 2 0 0 0 2.8284 0l1.5858-1.5857 4 3.9973zm0-5.8318-2.5858-2.5859a2 2 0 0 0 -2.8284 0l-1.5858 1.5859-2.377-2.3771 9.377-9.377z"
                            />
                            <path
                              d="m6 22v-3l5-4.9966 1.3733 1.3733 1.4159-1.416-1.375-1.375a2 2 0 0 0 -2.8284 0l-3.5858 3.5859v-10.1716h16v-2h-16a2.002 2.002 0 0 0 -2 2v16z"
                            />
                            <path d="m0 0h32v32h-32z" fill="none" />
                          </svg>
                        </span>

                      </div>
                      <div class="flex-grow-1">
                        
                        <p class="msg-info" style="margin-left: 10px">{{ item.name }}</p>
                      </div>
                    </div>
                  </a>
                </div>

                
              </div>
            </li>
            <li class="nav-item dropdown dropdown-large">
              <a
                class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
               
                <i class="bx bx-shopping-bag"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a href="javascript:;">
                  <div class="msg-header">
                    <p class="msg-header-title">Top Customer of this month</p>
                    
                  </div>
                </a>
                <div class="header-message-list">

                  <a  v-for="(item, index) in this.top_customer"
                    :key="index" class="dropdown-item" href="javascript:;">
                    <div class="d-flex align-items-center gap-3">
                      <div class="position-relative">
                        {{ index+1 }}
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="cart-product-title mb-0">
                          {{ item.customer.name }}
                        </h6>
                        <p class="cart-product-price mb-0">{{ item.customer.address }}</p>
                      </div>
                      <div class="">
                        <p class="cart-price mb-0">${{ item.g_total }}</p>
                      </div>
                      
                    </div>
                  </a>
                 
                 
                 
                </div>
                <a href="javascript:;">
                  <div class="text-center msg-footer">
                    <div
                      class="d-flex align-items-center justify-content-between mb-3"
                    >
                      
                    </div>
                   
                  </div>
                </a>
              </div>
            </li>
          </ul>
        </div>
        <div class="user-box dropdown px-3">
          <a
            class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <img
              v-if="$store.state.avatar"
              :src="'https://appinventory.shuvobhowmik.xyz/images/' + $store.state.avatar"
              class="rounded-circle p-1 bg-primary"
              width="60"
              height="60"
            />
            <img
              v-else
              :src="require('../../../assets/images/avatars/avatar-2.png')"
              :alt="AltText"
              class="rounded-circle p-1 bg-primary"
              width="60"
              height="60"
            />

            <div class="user-info">
              <p class="user-name mb-0">{{ this.$store.state.name }}</p>
              <p class="designattion mb-0">Admin</p>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <router-link
                to="/profile"
                class="dropdown-item d-flex align-items-center"
              >
                <i class="bx bx-user fs-5"></i>
                <span>Profile</span>
              </router-link>
            </li>
            <li>
              <router-link
                class="dropdown-item d-flex align-items-center"
                to="/setting"
              >
                <i class="bx bx-cog fs-5"></i>
                <span>Settings</span>
              </router-link>
            </li>

            <!--- <li>
                <router-link class="dropdown-item d-flex align-items-center" to="/test">
                  <i class="bx bx-cog fs-5"></i>
                  <span>Test</span>
                </router-link>
              </li>  -->

            <li>
              <div class="dropdown-divider mb-0"></div>
            </li>
            <li>
              <a
                class="dropdown-item d-flex align-items-center"
                href="#"
                @click="logout"
                ><i class="bx bx-log-out-circle"></i><span>Logout</span></a
              >
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
</template>

<style>
@media only screen and (max-width: 767px) {
  .custom-link {
    display: none !important;
  }
}
</style>
