<script>
import Layout from "../Layout.vue";
import Swal from "sweetalert2";
import axios from "axios";
import Loader from "../../loader/Loader.vue";

export default {
  components: {
    Layout,
    Loader,
  },
  data() {
    return {
      dataTable: null,
      supplierData: {},
      totalQuantity: {},
      Gtotal: {},
      Pamount: {},
      Damount : {},
      purchaseData: [],
      loading: true,
    };
  },

  mounted() {
    this.getSupplier(this.$route.params.id);
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

    getSupplier(supplierId) {
      const token = this.$store.state.token;
      console.log(token);
      axios
        .get(`http://localhost:8000/api/supplier-details/${supplierId}`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.supplierData = response.data.supplier_data;
          this.purchaseData = response.data.purchase_data;
          this.totalQuantity = response.data.total_quantity;
          this.Gtotal = response.data.g_total;
          this.Pamount = response.data.p_amount;
          this.Damount = response.data.d_amount;

        });
    },

    customerDelete(supplierId) {
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
            .get(`http://localhost:8000/api/delete-supplier/${supplierId}`, {
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
              this.getCustomer();
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
      <div class="page-wrapper">
        <div class="page-content">
          <div>
            <div
              class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"
            >
              <div class="breadcrumb-title pe-3">Supplier Profile</div>
              <div class="ps-3">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                      <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Supplier Profile
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="ms-auto">
                <div class="btn-group">
                  <router-link to="/supplier" type="button" class="btn btn-primary">
                    Go Back
                  </router-link>
                  
                </div>
              </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
              <div class="main-body">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <div
                          class="d-flex flex-column align-items-center text-center"
                        >
                          <img
                            v-if="$store.state.avatar"
                            :src="
                              'http://localhost:8000/images/' +
                              $store.state.avatar
                            "
                            class="rounded-circle p-1 bg-primary"
                            width="110"
                            height="110"
                          />
                          <img
                            v-else
                            :src="
                              require('../../../assets/images/avatars/avatar-2.png')
                            "
                            :alt="AltText"
                            class="rounded-circle p-1 bg-primary"
                            width="110"
                            height="110"
                          />

                          <div class="mt-3">
                            <h4>{{ supplierData.name }}</h4>
                            <p class="text-secondary mb-1">
                              {{ supplierData.address }}
                            </p>

                            <button class="btn btn-primary">Follow</button>
                            <button
                              class="btn btn-outline-primary"
                              style="margin-left: 10px"
                            >
                              Message
                            </button>
                          </div>
                        </div>
                        <hr class="my-4" />
                        <table class="table table-dark table-striped">
                          <thead>
                            <tr>
                              <th>T.Qty</th>
                            <th>G.Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            </tr>
                            
                          </thead>
                          <tbody>
                            <tr>
                              <td>{{ totalQuantity }}</td>
                              <td>{{ Gtotal }}</td>
                              <td>{{ Pamount }}</td>
                              <td>{{ Damount }}</td>
                            </tr>
                          </tbody>
                          

                        </table>
                        
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-8">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table mb-0 table-dark table-striped mt-5">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Product Name</th>
                              <th scope="col">Date</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Grand Total</th>
                              <th scope="col">Paid Amount</th>
                              <th scope="col">Due Amount</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(item, index) in this.purchaseData"
                              :key="index"
                            >
                              <th scope="row">{{ index + 1 }}</th>
                              <td>{{ item.product.name }}</td>
                              <td>{{ item.date }}</td>
                              <td>{{ item.qty }}</td>
                              <td>{{ item.g_total }}</td>
                              <td>{{ item.p_amount }}</td>
                              <td>{{ item.d_amount }}</td>

                              <td v-if="item.status === 'Ordered'">
                                <span
                                  class="badge bg-success"
                                  style="font-size: 13px"
                                  >{{ item.status }}</span
                                >
                              </td>

                              <td v-if="item.status === 'Received'">
                                <span
                                  class="badge bg-primary"
                                  style="font-size: 13px"
                                  >{{ item.status }}</span
                                >
                              </td>


                              <td v-else>
                                <span
                                  class="badge bg-warning"
                                  style="font-size: 13px"
                                  >{{ item.status }}</span
                                >
                              </td>

                              <td>

                                <router-link
                       :to="'/purchase/edit/' + item.id"
                        
                        class="btn btn-success btn-sm"
                      >
                        <i class="bx bx-pencil mr-1"></i>
                      </router-link>

                              </td>

                             
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end page wrapper -->
    </div>
  </div>
</template>
