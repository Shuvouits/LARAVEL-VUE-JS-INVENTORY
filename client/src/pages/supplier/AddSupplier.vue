<script>
import Layout from "../Layout.vue";
import "select2";
import axios from "axios";
import Swal from "sweetalert2";

export default {


  components: {
    Layout,
  },

  
  data() {
    return {
      name: "",
      address: "",
      formData: new FormData(),
    };
  },

  methods: {

    sendData() {

      const token = this.$store.state.token;

      this.formData.append("name", this.name);
      this.formData.append("address", this.address);

      axios
        .post("http://localhost:8000/api/add-supplier", this.formData, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
          //params: data,
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

          this.$router.push("/supplier");
        })
        .catch((error) => {
          console.log(error);
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

  mounted() {
    $(this.$refs.selectElement).select2();
    $(this.$refs.selectElement1).select2();
  },
  destroyed() {
    $(this.$refs.selectElement).select2("destroy");
    $(this.$refs.selectElement1).select2("destroy");
  },

 

  
};

</script>

<template>
  <div>
    <Layout />

    <!--start page wrapper -->
    <div class="page-wrapper">
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
                  Supplier
                </li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
              <router-link to="/supplier">
                <button type="button" class="btn btn-primary">Go Back</button>
              </router-link>
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <router-link to="/sales"
          ><h6 class="mb-0 text-uppercase">Insert Supplier</h6></router-link
        >

        <hr />
        <div class="card">
          <div class="card-body p-4">
            <h5 class="mb-4">Add Supplier</h5>

            <form class="row g-3" @submit.prevent="sendData">
             

              <div class="col-md-6">
                <label for="input14" class="form-label">Suppler Name</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="input14"
                    v-model="name"
                    placeholder="Enter Name"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Address</label>
                <div class="position-relative input-icon">
                  <input
                    type="price"
                    class="form-control"
                    id="input14"
                    v-model="address"
                    placeholder="Enter Address"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-message-add"></i
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
</template>


