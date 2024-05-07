<script>
import Layout from "../Layout.vue";
import axios from "axios";
import Swal from "sweetalert2";

export default {

    data() {
    return {
      name: '',
      slug: '',
      status: ''
    };
  },

  computed: {
    categorySlugAuto() {
      // Convert category name to a slug
      return this.name.toLowerCase().replace(/\s+/g, '-');
    }
  },

  watch: {
    name(newValue) {
      // Update category slug whenever category name changes
      this.slug = this.categorySlugAuto;
    }
  },

  

  methods : {

    sendData() {
      const data = {
        // Your data to send to the API
        name: this.name,
        slug: this.slug,
        status : this.status
      };

      const token = this.$store.state.token;

      axios
        .post("http://localhost:8000/api/add-category", data,{

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

          this.$router.push("/category-list");
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


  components: {
    Layout,
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
                  Category
                </li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
              <router-link to="/category-list">
                <button type="button" class="btn btn-primary">
                  Category List
                </button>
              </router-link>
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Manage Category</h6>

        <hr />
        <div class="card">
          <div class="card-body p-4">
            <h5 class="mb-4">Create Category</h5>
            <form class="row g-3" @submit.prevent="sendData">
              <div class="col-md-6">
                <label for="cname" class="form-label">Category Name</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="cname"
                    v-model="name"
                    placeholder="First Name"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-intersect"></i
                  ></span>
                </div>
              </div>
              <div class="col-md-6">
                <label for="slug"  class="form-label">Slug</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="slug"
                    v-model="slug"
                    placeholder="Last Name"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-grid-small"></i
                  ></span>
                </div>
              </div>
             

              <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select id="status" v-model="status" class="form-select">
                  <option selected="" disabled>Choose...</option>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
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
