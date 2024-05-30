<script>
import Layout from "../Layout.vue";
import axios from "axios";
import Swal from "sweetalert2";

export default {
  components: {
    Layout,
  },

  data() {
    return {
      imageUrl: null,
      name: "",
      slug: "",
      status: "Active",
      formData: new FormData(),
    };
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
        .post("https://appinventory.shuvobhowmik.xyz/api/add-brand", this.formData, {
          headers: {
            "Content-Type": "multipart/form-data",
            Authorization: `Bearer ${token}`,
          },
          params: data,
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
                  Brand
                </li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
             
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <div style="display: flex; align-items: center; justify-content: space-between;">
          <h6 class="mb-0 text-uppercase">Manage Brand</h6>
          <router-link to="/brand-list">
                <button type="button" class="btn btn-primary">
                  Brand List
                </button>
              </router-link>
        </div>
        

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