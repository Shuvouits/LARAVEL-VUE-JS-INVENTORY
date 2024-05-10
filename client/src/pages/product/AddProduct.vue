<script>
import Layout from "../Layout.vue";
import axios from "axios";

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
    };
  },

  mounted() {
    this.getBrands();
    this.getCategory();
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
          this.brand = response.data.filter(item => item.status === 'Active');

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
          this.category = response.data.filter(item => item.status === 'Active');
        });
    },


  }


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
            <form class="row g-3">
              <div class="col-md-6">
                <label for="input13" class="form-label">Product Name</label>
                <div class="position-relative input-icon">
                  <input
                    type="text"
                    class="form-control"
                    id="input13"
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
                    type="text"
                    class="form-control"
                    id="input15"
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
                  placeholder="Date of Birth"
                />
              </div>

              <div class="col-md-6">
                <label for="input21" class="form-label">Category</label>
                <select id="input21" name="category" class="form-select">
                  <option selected="" >Choose...</option>
              
                  <option v-for="(item, index) in category" :key="index" >{{ item.name }}</option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="input21" class="form-label">Brand</label>
                <select id="input21" name="brand" class="form-select">
                  <option selected="">Choose...</option>
                  <option v-for="(item, index) in brand" :key="index" >{{ item.name }}</option>
                  
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
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
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
