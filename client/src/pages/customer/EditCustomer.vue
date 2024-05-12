<script>
import Layout from "../Layout.vue";
import axios from "axios";
import Swal from "sweetalert2";
import Loader from "../../loader/Loader.vue";

export default {
  components: {
    Layout,
    Loader
  },

  data() {
    return {
     
      name: "",
      address: "",
      formData: new FormData(),
      loading: true
    };
  },

  mounted() {
    this.getSupplier(this.$route.params.id);
  },

  


  methods: {
    
    getSupplier(customerId) {
      const token = this.$store.state.token;

      axios
        .get(`http://localhost:8000/api/customer/edit/${customerId}`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.name = response.data.name
          this.address = response.data.address
          
        });
    },

    

    sendData() {
      const data = {
        // Your data to send to the API
        name: this.name,
        address: this.address,
      };

      const token = this.$store.state.token;

      axios
        .post(`http://localhost:8000/api/update-customer/${this.$route.params.id}`, data, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },

        })
        .then((response) => {
          console.log(response.data);

          Swal.fire({
            toast: true,
            position: "top-right",
            animation: true,
            text: response.data.message,
            icon: "success",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });

          this.$router.push("/customer");
        })
        .catch((error) => {
          console.error(error);
          Swal.fire({
            toast: true,
            position: "top-right",
            animation: true,
            text: error.response.data.message,
            icon: "error",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
        });
    },
  },




};
</script>

<template>

  <div>

    <div
      v-if="loading"
      style="position: fixed; top: 50%; left: 50%; z-index: 1000"
    >
      <Loader />
    </div>


    <div>
    <Layout />

    <!--start page wrapper -->
    <div class="page-wrapper" :style="{ opacity: loading ? 0.5 : '' }">
      <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
          <div class="breadcrumb-title pe-3">Dashboard</div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                  <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Customer
                </li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
              <router-link to="/brand-list">
                <button type="button" class="btn btn-primary">
                  Customer List
                </button>
              </router-link>
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Manage Customer</h6>

        <hr />
        <div class="card">
          <div class="card-body p-4">
            <h5 class="mb-4">Update Customer</h5>
            <form
              class="row g-3"
              @submit.prevent="sendData"
             
            >
              <div class="col-md-6">
                <label for="input13" class="form-label">Customer Name</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="input13"
                    v-model="name"
                    placeholder="Enter Supplier name"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-shuffle"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input13" class="form-label">Address</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="input13"
                    v-model="address"
                    placeholder="Enter Address"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-credit-card-front"></i
                  ></span>
                </div>
              </div>

            

              <div class="col-md-12">
                <div class="d-md-flex d-grid align-items-center gap-3">
                  <button type="submit" class="btn btn-primary px-4">
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--end page wrapper -->
  </div>

  </div>



</template>