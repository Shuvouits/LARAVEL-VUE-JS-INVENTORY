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
      supplier: [],
      loading: true
    };
  },

  mounted() {
    this.getSupplier();
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

    getSupplier() {
      const token = this.$store.state.token;
      console.log(token);
      axios
        .get("https://appinventory.shuvobhowmik.xyz/api/all-supplier", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          //console.log(response.data);
          this.loading = false;
          this.supplier = response.data;

          // After setting the data, initialize DataTables
          this.initDataTable();
        });
    },

    supplierDelete(supplierId) {
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
            .get(`https://appinventory.shuvobhowmik.xyz/api/delete-supplier/${supplierId}`, {
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
              this.getSupplier();
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
                  Brand
                </li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group">
              <router-link to="/add-supplier">
                <button
                  type="button"
                  class="btn btn-primary"
                  style="margin-left: 30px"
                >
                  Add Supplier
                </button>
              </router-link>
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Manage Your Brand</h6>

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
                    <th>Id</th>
                    <th>Supplier Name</th>
                    <th>Address</th>
                    <th>Created On</th>
                    

                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in this.supplier" :key="index">
                    <td style="padding-top: 20px; padding-bottom: 20px">
                      {{ index + 1 }}
                    </td>
                    <td style="padding-top: 20px; padding-bottom: 20px">
                      {{ item.name }}
                    </td>
                    <td>
                        {{ item.address }}
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
                        :to="'/supplier/details/' + item.id"
                        type="button"
                        class="btn btn-primary px-5"
                      >

                      

<svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 width="22px" height="22px" viewBox="0 0 442.04 442.04"
	 xml:space="preserve">
<g>
	<g>
		<path d="M221.02,341.304c-49.708,0-103.206-19.44-154.71-56.22C27.808,257.59,4.044,230.351,3.051,229.203
			c-4.068-4.697-4.068-11.669,0-16.367c0.993-1.146,24.756-28.387,63.259-55.881c51.505-36.777,105.003-56.219,154.71-56.219
			c49.708,0,103.207,19.441,154.71,56.219c38.502,27.494,62.266,54.734,63.259,55.881c4.068,4.697,4.068,11.669,0,16.367
			c-0.993,1.146-24.756,28.387-63.259,55.881C324.227,321.863,270.729,341.304,221.02,341.304z M29.638,221.021
			c9.61,9.799,27.747,27.03,51.694,44.071c32.83,23.361,83.714,51.212,139.688,51.212s106.859-27.851,139.688-51.212
			c23.944-17.038,42.082-34.271,51.694-44.071c-9.609-9.799-27.747-27.03-51.694-44.071
			c-32.829-23.362-83.714-51.212-139.688-51.212s-106.858,27.85-139.688,51.212C57.388,193.988,39.25,211.219,29.638,221.021z"/>
	</g>
	<g>
		<path d="M221.02,298.521c-42.734,0-77.5-34.767-77.5-77.5c0-42.733,34.766-77.5,77.5-77.5c18.794,0,36.924,6.814,51.048,19.188
			c5.193,4.549,5.715,12.446,1.166,17.639c-4.549,5.193-12.447,5.714-17.639,1.166c-9.564-8.379-21.844-12.993-34.576-12.993
			c-28.949,0-52.5,23.552-52.5,52.5s23.551,52.5,52.5,52.5c28.95,0,52.5-23.552,52.5-52.5c0-6.903,5.597-12.5,12.5-12.5
			s12.5,5.597,12.5,12.5C298.521,263.754,263.754,298.521,221.02,298.521z"/>
	</g>
	<g>
		<path d="M221.02,246.021c-13.785,0-25-11.215-25-25s11.215-25,25-25c13.786,0,25,11.215,25,25S234.806,246.021,221.02,246.021z"/>
	</g>
</g>
</svg>


                        Details
                      </router-link>

                      <router-link
                       :to="'/supplier/edit/' + item.id"
                        
                        class="btn btn-success px-5"
                      >
                        <i class="bx bx-pencil mr-1"></i>Edit
                      </router-link>

                      <button
                        type="button"
                        class="btn btn-danger px-5"
                        @click="supplierDelete(item.id)"
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