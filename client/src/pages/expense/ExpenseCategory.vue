<script>
import Layout from "../Layout.vue";
import Swal from "sweetalert2";
import axios from "axios";
import Loader from "../../loader/Loader.vue";

export default {
  components: {
    Layout,
    Loader
  },
  data() {
    return {
      dataTable: null,
      expenseData: [],
      loading: true
    };
  },

  mounted() {
    this.getExpenseCategory();
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

    getExpenseCategory() {
      const token = this.$store.state.token;
      console.log(token);
      axios
        .get("http://localhost:8000/api/all-category-expense", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          //console.log(response.data);
          this.loading = false;
          this.expenseData = response.data;

          // After setting the data, initialize DataTables
          this.initDataTable();
          
        });
    },

    expenseDelete(id) {
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
            .get(`http://localhost:8000/api/delete-expense/${id}`, {
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
              this.getExpenseCategory();
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

    statusUpdate(brandId) {
      const token = this.$store.state.token;
      this.loading = true;

      axios
        .get(`http://localhost:8000/api/update-brand-status/${brandId}`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.getBrands();
          this.loading=false;
          

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

    initDataTable() {
      // Destroy existing DataTable if it exists
      if (this.dataTable) {
        this.dataTable.destroy();
        this.dataTable = null;
      }

      // Initialize DataTable
      this.$nextTick(() => {
        this.dataTable = $("#example").DataTable();
      });
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
          <div class="breadcrumb-title pe-3">Dashboard</div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                  <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Expense | Category
                </li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
              <router-link to="/add-category-expense">
                <button
                  type="button"
                  class="btn btn-primary"
                  style="margin-left: 30px"
                >
                  Add Expense Category
                </button>
              </router-link>
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Manage Your Expense Category</h6>

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
                    <th>Category Name</th>
                   
                    <th>Date</th>
                    

                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in this.expenseData" :key="index">
                    <td style="padding-top: 20px; padding-bottom: 20px">
                      {{ index + 1 }}
                    </td>
                    <td style="padding-top: 20px; padding-bottom: 20px">
                      {{ item.name }}
                    </td>
                    
                    <td style="padding-top: 20px; padding-bottom: 20px">
                      {{ formatDate(item.created_at) }}
                    </td>

                   
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
                        :to="'/expense/category/edit/' + item.id"
                        type="button"
                        class="btn btn-primary px-5"
                      >
                        <i class="bx bx-pencil mr-1"></i>Edit
                      </router-link>
                      <button
                        type="button"
                        class="btn btn-danger px-5"
                        @click="expenseDelete(item.id)"
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