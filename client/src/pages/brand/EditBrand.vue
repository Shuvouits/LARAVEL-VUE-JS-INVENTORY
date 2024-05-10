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
      imageUrl: null,
      name: "",
      slug: "",
      status: "Active",
      formData: new FormData(),
      loading: true
    };
  },

  mounted() {
    this.getBrands(this.$route.params.id);
  },

  computed: {
    brandSlugAuto() {
      // Convert category name to a slug
      return this.name.toLowerCase().replace(/\s+/g, "-");
    },
  },

  watch: {
    name(newValue) {
      // Update category slug whenever category name changes
      this.slug = this.brandSlugAuto;
    },
  },

  methods: {
    
    getBrands(brandId) {
      const token = this.$store.state.token;

      axios
        .get(`http://localhost:8000/api/brand/edit/${brandId}`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.name = response.data.name
          this.slug = response.data.slug
          this.status = response.data.status
          this.avatar = response.data.avatar
          
        });
    },

    uploadImage(event) {
      const file = event.target.files[0];
      this.imageUrl = URL.createObjectURL(file);

      console.log(this.imageUrl);

      this.formData.append("avatar", file);
    },

    sendData() {
      const data = {
        // Your data to send to the API
        name: this.name,
        slug: this.slug,
        status: this.status,
      };

      const token = this.$store.state.token;

      axios
        .post(`http://localhost:8000/api/update-brand/${this.$route.params.id}`, this.formData, {
          headers: {
            "Content-Type": "multipart/form-data",
            Authorization: `Bearer ${token}`,
          },
          params : data
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

          this.$router.push("/brand-list");
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
                  Brand
                </li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
              <router-link to="/brand-list">
                <button type="button" class="btn btn-primary">
                  Brand List
                </button>
              </router-link>
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Manage Brand</h6>

        <hr />
        <div class="card">
          <div class="card-body p-4">
            <h5 class="mb-4">Create Brand</h5>
            <form
              class="row g-3"
              @submit.prevent="sendData"
              enctype="multipart/form-data"
            >
              <div class="col-md-6">
                <label for="input13" class="form-label">Brand Name</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="input13"
                    v-model="name"
                    placeholder="Enter brand name"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-shuffle"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input13" class="form-label">Slug</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="input13"
                    v-model="slug"
                    placeholder="Enter Slug"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-credit-card-front"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select id="status" v-model="status" class="form-select">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="input13" class="form-label">Image</label>
                <div class="position-relative input-icon">
                  <input
                    type="file"
                    class="form-control"
                    id="input13"
                    @change="uploadImage"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-cloud-upload"></i
                  ></span>

                 
                </div>
                <div>
                  <img
                    v-if="imageUrl"
                    :src="imageUrl"
                    alt="Preview"
                    style="
                      width: 120px;
                      height: 120px;
                      border-radius: 10px;
                      margin-top: 20px;
                    "
                  />

                  <img
                    v-if="avatar && !imageUrl"
                    :src="'http://localhost:8000/images/' +avatar"
                    alt="Preview"
                    style="
                      width: 120px;
                      height: 120px;
                      border-radius: 10px;
                      margin-top: 20px;
                    "
                  />

                  <span v-if="!avatar && !imageUrl">
                    <img src="data:image/svg+xml,%3Csvg height='120' viewBox='0 0 32 32' width='120' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='m30 3.4141-1.4141-1.4141-26.5859 26.5859 1.4141 1.4141 2-2h20.5859a2.0027 2.0027 0 0 0 2-2v-20.5859zm-4 22.5859h-18.5859l7.7929-7.793 2.3788 2.3787a2 2 0 0 0 2.8284 0l1.5858-1.5857 4 3.9973zm0-5.8318-2.5858-2.5859a2 2 0 0 0 -2.8284 0l-1.5858 1.5859-2.377-2.3771 9.377-9.377z'/%3E%3Cpath d='m6 22v-3l5-4.9966 1.3733 1.3733 1.4159-1.416-1.375-1.375a2 2 0 0 0 -2.8284 0l-3.5858 3.5859v-10.1716h16v-2h-16a2.002 2.002 0 0 0 -2 2v16z'/%3E%3Cpath d='m0 0h32v32h-32z' fill='none'/%3E%3C/svg%3E" alt="SVG Image" />

                  </span>

                

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