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
      dataTable: null,
      brand: [],
      loading: true,
      category: [],
      name: "",
      slug: "",
      price: "",
      quantity: "",
      date: "",
      category: "",
      brand: "",
      expire_date: "",
      imageUrl: null,
      formData: new FormData(),
    };
  },

  mounted() {
    this.getBrands();
    this.getCategory();
  },

  computed: {
    productSlugAuto() {
      // Convert category name to a slug
      return this.name.toLowerCase().replace(/\s+/g, "-");
    },
  },

  watch: {
    name(newValue) {
      // Update category slug whenever category name changes
      this.slug = this.productSlugAuto;
    },
  },

  methods: {
    getBrands() {
      const token = this.$store.state.token;
      console.log(token);
      axios
        .get("http://localhost:8000/api/all-brand", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.brand = response.data.filter((item) => item.status === "Active");
        });
    },

    uploadImage(event) {
      const file = event.target.files[0];
      this.imageUrl = URL.createObjectURL(file);

      console.log(this.imageUrl);

      this.formData.append("avatar", file);
    },

    sendData() {
      const token = this.$store.state.token;

      this.formData.append("name", this.name);
      this.formData.append("slug", this.slug);
      this.formData.append("price", this.price);
      this.formData.append("quantity", this.quantity);
      this.formData.append("expire_date", this.expire_date);
      this.formData.append("category", this.category.id);
      this.formData.append("brand", this.brand.id);

      axios
        .post("http://localhost:8000/api/add-product", this.formData, {
          headers: {
            "Content-Type": "multipart/form-data",
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

    getCategory() {
      const token = this.$store.state.token;
      console.log(token);
      axios
        .get("http://localhost:8000/api/all-category", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.category = response.data.filter(
            (item) => item.status === "Active"
          );
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
          <div class="breadcrumb-title pe-3">Tables</div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                  <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Product Information
                </li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
              <router-link to="/add-router">
                <button type="button" class="btn btn-primary">
                  Add Product
                </button>
              </router-link>
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Insert Your Product</h6>

        <hr />
        <div class="card">
          <div class="card-body p-4">
            <h5 class="mb-4">Product Information</h5>
            <form
              class="row g-3"
              @submit.prevent="sendData"
              enctype="multipart/form-data"
            >
              <div class="col-md-6">
                <label for="input13" class="form-label">Product Name</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="input13"
                    v-model="name"
                    placeholder="Enter Product Name"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-coin-stack"></i
                  ></span>
                </div>
              </div>
              <div class="col-md-6">
                <label for="input14" class="form-label">Slug</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="input14"
                    v-model="slug"
                    placeholder="Enter your slug"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-caret-left-circle"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input15" class="form-label">Price</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="input15"
                    v-model="price"
                    placeholder="Enter the price of product"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-dollar-circle"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input15" class="form-label">Quantity</label>
                <div class="position-relative input-icon">
                  <input
                    type="number"
                    class="form-control"
                    id="input15"
                    v-model="quantity"
                    placeholder="Enter the quantity of product"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-disc"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input6" class="form-label">Expire of Date</label>
                <input
                  type="date"
                  class="form-control"
                  id="input6"
                  v-model="expire_date"
                  placeholder="Date of Birth"
                />
              </div>

              <div class="col-md-6">
                <label for="c_data" class="form-label">Category</label>
                <select
                  id="c_data"
                  v-model="category.id"
                  name="category"
                  class="form-select"
                >
                  <option selected disabled>Choose...</option>

                  <option v-for="(item, index) in category" :value="item.id" :key="index">
                    {{ item.name }}
                  </option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="brand" class="form-label">Brand</label>
                <select
                  id="brand"
                  name="brand"
                  v-model="brand.id"
                  class="form-select"
                >
                  <option selected disabled>Choose...</option>
                  <option v-for="(item, index) in brand" :value="item.id"  :key="index">
                    {{ item.name }}
                  </option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Choose Image</label>
                <div class="position-relative input-icon">
                  <input
                    type="file"
                    class="form-control"
                    id="input14"
                    placeholder="Last Name"
                    @change="uploadImage"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
                  ></span>
                </div>

                <div>
                  <img
                    v-if="imageUrl"
                    :src="imageUrl"
                    alt="Preview"
                    style="
                      width: 150px;
                      height: 70px;
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
