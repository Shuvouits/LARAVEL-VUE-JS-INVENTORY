<script>
import Layout from "../Layout.vue";
import axios from "axios";
import Loader from '../../loader/Loader.vue'
import Swal from "sweetalert2";

export default {
  components: {
    Layout,
    Loader
  },
  data() {
    return {
      dataTable: null,
      product: [],
      oproduct: [],
      visible: true,
      loading: true,
    };
  },

  mounted() {
    this.lowStockProduct();
    this.outStockProduct();
  },

  beforeRouteEnter(to, from, next) {
    next((vm) => {
      vm.initDataTable();
    });
  },
  beforeRouteLeave(to, from, next) {
    this.destroyDataTable();
    next();
  },

  methods: {
    formatDate(dateString) {
      // Create a new Date object from the dateString
      const date = new Date(dateString);

      // Define options for formatting
      const options = {
        day: "numeric",
        month: "long", // Use long month name
        year: "numeric",
      };

      // Format the date using options
      const formattedDate = date.toLocaleDateString("en-GB", options);

      return formattedDate;
    },

    lowStockProduct() {
      const token = this.$store.state.token;
      axios
        .get("http://localhost:8000/api/low-stock", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.product = response.data;

          // After setting the data, initialize DataTables
          this.initDataTable();
        });
    },

    outStockProduct() {
      const token = this.$store.state.token;
      axios
        .get("http://localhost:8000/api/out-stock", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.oproduct = response.data;

          // After setting the data, initialize DataTables
          this.initDataTable();
        });
    },

    productDelete(productId) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          const token = this.$store.state.token;

          axios
            .get(`http://localhost:8000/api/delete-product/${productId}`, {
              headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
              },
            })
            .then((response) => {
              // Handle success response
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

              // Refresh the category list or update the UI accordingly
              this.lowStockProduct();
              this.outStockProduct();
            })
            .catch((error) => {
              // Handle error response
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
        }
      });
    },

    lowStock() {
      this.visible = true; // Toggles the state between true and false
    },

    outStock() {
      this.visible = false; // Toggles the state between true and false
    },

    initDataTable() {
      this.dataTable = $("#example").DataTable();
    },
    destroyDataTable() {
      if (this.dataTable) {
        this.dataTable.destroy();
        this.dataTable = null;
      }
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
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item">
                    <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Low Stock
                  </li>
                </ol>
              </nav>
            </div>
            <div class="ml-auto">
              <div class="btn-group">
                <button
                  type="button"
                  @click="lowStock"
                  class="btn btn-primary"
                  style="margin-left: 30px"
                >
                  Low Stock
                </button>
                <button
                  type="button"
                  @click="outStock"
                  class="btn btn-primary"
                  style="margin-left: 30px"
                >
                  Out Of Stock
                </button>
              </div>
            </div>
          </div>
          <!--end breadcrumb-->
          <h6 v-if="visible" class="mb-0 text-uppercase">
            Manage Your Low Stock
          </h6>
          <h6 v-else class="mb-0 text-uppercase">Manage Your Out Stock</h6>

          <hr />
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table
                  id="example"
                  class="table table-striped table-bordered"
                  style="width: 100%"
                >
                  <thead>
                    <tr>
                        <th>Sl</th>
                      <th>Product</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Qty</th>
                      <th>Expired Date</th>

                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-if="visible"
                      v-for="(item, index) in product"
                      :key="index"
                    >
                    <td>{{ index+1 }}</td>
                      <td>
                        <img
                          v-if="item.avatar"
                          :src="'http://localhost:8000/images/' + item.avatar"
                          style="width: 50px; height: 50px; border-radius: 5px"
                        />

                        <span v-else>
                          <svg
                            height="50"
                            viewBox="0 0 32 32"
                            width="50"
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
                        <span style="margin-left: 25px">{{ item.name }}</span>
                      </td>
                      <td>{{ item.category_data.name }}</td>
                      <td>{{ item.brand_data.name }}</td>
                      <td>{{ item.quantity }}</td>
                      <td>{{ formatDate(item.expire_date) }}</td>

                      <td
                        style="
                          display: flex;
                          align-items: center;
                          justify-content: flex-start;
                          gap: 10px;
                          padding-top: 20px;
                          padding-bottom: 20px;
                        "
                      >
                        <router-link
                          :to="'/product/edit/' + item.id"
                          type="button"
                          class="btn btn-primary px-5"
                        >
                          <i class="bx bx-pencil mr-1"></i>Edit
                        </router-link>
                        <button
                          type="button"
                          class="btn btn-danger px-5"
                          @click="productDelete(item.id)"
                        >
                          <i class="bx bx-trash mr-1"></i>trash
                        </button>
                      </td>
                    </tr>

                    <tr v-else v-for="(data, index) in oproduct" :key="data">
                        <td>{{ index+1 }}</td>
                      <td>
                        <img
                          v-if="data.avatar"
                          :src="'http://localhost:8000/images/' + data.avatar"
                          style="width: 50px; height: 50px; border-radius: 5px"
                        />

                        <span v-else>
                          <svg
                            height="50"
                            viewBox="0 0 32 32"
                            width="50"
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
                        <span style="margin-left: 25px">{{ data.name }}</span>
                      </td>
                      <td>{{ data.category_data.name }}</td>
                      <td>{{ data.brand_data.name }}</td>
                      <td>{{ data.quantity }}</td>
                      <td>{{ formatDate(data.expire_date) }}</td>

                      <td
                        style="
                          display: flex;
                          align-items: center;
                          justify-content: flex-start;
                          gap: 10px;
                          padding-top: 20px;
                          padding-bottom: 20px;
                        "
                      >
                        <router-link
                          :to="'/product/edit/' + data.id"
                          type="button"
                          class="btn btn-primary px-5"
                        >
                          <i class="bx bx-pencil mr-1"></i>Edit
                        </router-link>
                        <button
                          type="button"
                          class="btn btn-danger px-5"
                          @click="productDelete(data.id)"
                        >
                          <i class="bx bx-trash mr-1"></i>trash
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end page wrapper -->
    </div>
  </div>
</template>
