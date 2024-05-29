<script>
import axios from "axios";

import { mapActions } from "vuex";
import Loader from "../loader/Loader.vue";

export default {
  components: {
    Loader,
  },

  data() {
    return {
      phone: "",
      password: "",
      loading: false,
      errorMessage: "",
      theme: "",
      visible: false,
      top_customer : [],
      out_of_stock: [],
    };
  },

  ...mapActions(["storeUserData"]),



  methods: {

    handleClick(){
      this.visible = !this.visible
    },

    handleTheme() {
      this.theme = "semi-dark";
      localStorage.setItem("theme", this.theme);
      document.documentElement.className = this.theme;
    },


   

   

    sendData() {
      this.loading = true;
      const data = {
        phone: this.phone,
        password: this.password,
      };

      axios
        .post("http://localhost:8000/api/login", data)
        .then((response) => {
          console.log(response.data);

          this.loading = false;

          const { token, phone, name, email, address, avatar, top_customer, out_of_stock } = response.data;
          this.$store.dispatch("storeUserData", { token, phone, name, email, address, avatar, top_customer, out_of_stock });
          
          this.handleTheme();

         this.$router.push("/dashboard");
        })
        .catch((error) => {
          this.loading = false;
          this.errorMessage = error.response.data.message;
          console.error(error);
        });
    },
  },
};
</script>

<template>
  <!--wrapper-->
  <div>
    <div
      v-if="loading"
      style="position: fixed; top: 35%; left: 35%; z-index: 1000"
    >
      <Loader />
    </div>

    <div class="wrapper" :style="{ opacity: loading ? 0.5 : '' }">
      <div class="section-authentication-cover">
        <div class="">
          <div class="row g-0">
            <div
              class="col-12 col-xl-7 col-xxl-8 auth-cover-left bg-gradient-cosmic align-items-center justify-content-center d-none d-xl-flex"
            >
              <div
                class="card shadow-none bg-transparent shadow-none rounded-0 mb-0"
              >
                <div class="card-body">
                  <img
                    src="../../assets/images/login-images/login-cover.svg"
                    class="img-fluid auth-img-cover-login"
                    width="650"
                    alt=""
                  />
                </div>
              </div>
            </div>

            <div
              class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center"
            >
              <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                <div class="card-body p-sm-5">
                  <div class="">
                    <div class="mb-3 text-center">
                      <img
                        src="../../assets/images/logo-icon.png"
                        width="60"
                        alt=""
                      />
                    </div>
                    <div class="text-center mb-4">
                      <h5 class="">BikeBuzz || Inventory</h5>
                      <p class="mb-0">Please log in to your account</p>
                    </div>
                    <div class="form-body">
                      <form class="row g-3" @submit.prevent="sendData">
                        <div
                          v-if="errorMessage"
                          class="alert alert-danger alert-dismissible fade show"
                          role="alert"
                        >
                          <strong>Hey Hello!</strong> {{ errorMessage }}.
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                          ></button>
                        </div>

                        <div class="col-12">
                          <label for="phoneNumber" class="form-label"
                            >Phone</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            id="phoneNumber"
                            placeholder="Enter Your Phone Number"
                            v-model="phone"
                            required
                          />
                        </div>
                        <div class="col-12">
                          <label for="inputChoosePassword" class="form-label"
                            >Password</label
                          >
                          <div class="input-group" id="show_hide_password">
                            
                            <input
                              :type=" visible ? 'text' : 'password' "
                              class="form-control border-end-0"
                              id="inputChoosePassword"
                              placeholder="Enter Your Password"
                              v-model="password"
                              required
                            />
                            <a

                             @click="handleClick"
                              href="javascript:;"
                              class="input-group-text bg-transparent"
                              >
                              <i :class="visible ? 'bx bx-show' : 'bx bx-hide' "></i>
                            </a>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-check form-switch">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="flexSwitchCheckChecked"
                            />
                            <label
                              class="form-check-label"
                              for="flexSwitchCheckChecked"
                              >Remember Me</label
                            >
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                              Sign in
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--end row-->
        </div>
      </div>
    </div>
  </div>

  <!--end wrapper-->
</template>
