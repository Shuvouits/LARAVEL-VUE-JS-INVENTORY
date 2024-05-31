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
      expense: [],
      loading: true,
      date: new Date(),
      total_quantity: {},
      g_total: "",
      amount: "",
      d_amount: "",
      start_date: "",
      end_date: "",
      expense_report: [],
      visible: false,
    };
  },

  computed: {
    currentDate() {
      const options = { year: "numeric", month: "long" };
      return this.date.toLocaleDateString(undefined, options);
    },
  },

  mounted() {
    this.getExpense();
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
    reset() {
      this.visible = false;
      this.start_date = '';
      this.end_date = '';
      // Add your logic here
    },

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

    sendData() {
      const data = {
        start_date: this.start_date, // Ensure the correct data is sent
        end_date: this.end_date,
      };

      const token = this.$store.state.token;

      axios
        .post("https://appinventory.shuvobhowmik.xyz/api/expense-report-date", data, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data.purchase);
          this.expense_report = response.data.expense;
          this.amount = response.data.amount;
          this.visible = true;

          //console.log(this.sell_report)

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

    getExpense() {
      const token = this.$store.state.token;
      axios
        .get("https://appinventory.shuvobhowmik.xyz/api/expense-report", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          this.loading = false;
          this.expense = response.data.expense;
          console.log(this.expense)
         
          this.amount = response.data.amount;

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
            .get(`https://appinventory.shuvobhowmik.xyz/api/delete-expense/${id}`, {
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
              this.getPurchase();
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
      <div class="page-wrapper">
        <div class="page-content">
          <!--breadcrumb-->
          <div class="page-breadcrumb  d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item">
                    <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li  class="breadcrumb-item active" aria-current="page">
                    Expense Report ||
                    <span style="font-weight: bold">
                      <span :style="{ display: visible ? 'none' : '' }">{{
                        currentDate
                      }}</span>
                      <span :style="{ display: !visible ? 'none' : '' }"
                        >{{ start_date }} to {{ end_date }}</span
                      >
                    </span>
                    <span>
                      <Button
                        @click="reset"
                        class="btn btn-info"
                        style="width: 300px; margin-left: 15px"
                        >Reset</Button
                      >
                    </span>
                  </li>
                </ol>
              </nav>
            </div>
            <div class="ms-auto">
              <form @submit.prevent="sendData">
                <div class="btn-group">
                  <div>
                    <input
                      type="date"
                      class="form-control"
                      id="startD"
                      v-model="start_date"
                      placeholder="Date of Birth"
                    />
                  </div>

                  <div style="margin-left: 15px">
                    <input
                      type="date"
                      class="form-control"
                      id="end"
                      v-model="end_date"
                      placeholder="End Date"
                    />
                  </div>

                  <button
                    type="submit"
                    class="btn btn-primary"
                    style="margin-left: 30px"
                  >
                    Check Filter
                  </button>
                </div>
              </form>
            </div>
          </div>
          <!--end breadcrumb-->
          <h6 class="mb-0 text-uppercase">Manage Your Sales</h6>

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
                      <th>Amount</th>
                      <th>Date</th>
                      <th>Description</th>
                     
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody :style="{ display: visible ? 'none' : '' }">
                    <tr v-for="(item, index) in this.expense" :key="index">
                      <td>{{ index + 1 }}</td>
                      <td>{{ item.expense_category_data.name }}</td>
                      <td>{{ item.amount }}</td>
                      <td>{{ formatDate(item.date) }}</td>
                      <td>{{ item.description }}</td>

                      <td
                        style="
                          display: flex;
                          align-items: center;
                          justify-content: flex-start;
                          gap: 10px;
                        "
                      >
                        <router-link
                          :to="'/expense/edit/' + item.id"
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

                    <tr style="background: black">
                      <td style="color: brown; font-weight: bold">*</td>
                      <td style="color: brown; font-weight: bold">-</td>
                      <td style="color: brown; font-weight: bold">{{ amount }}</td>
                      <td style="color: brown; font-weight: bold">-</td>
                     
                      <td style="color: brown; font-weight: bold">-</td>
                      <td style="color: brown; font-weight: bold">-</td>
                    </tr>
                  </tbody>

                  <tbody :style="{ display: visible ? '' : 'none' }">
                    <tr style="background: black">
                        <td style="color: brown; font-weight: bold">*</td>
                      <td style="color: brown; font-weight: bold">-</td>
                      <td style="color: brown; font-weight: bold">{{ amount }}</td>
                      <td style="color: brown; font-weight: bold">-</td>
                     
                      <td style="color: brown; font-weight: bold">-</td>
                      <td style="color: brown; font-weight: bold">-</td>
                    </tr>

                    <tr v-for="(item, index) in this.expense_report" :key="index">
                      <td>{{ index + 1 }}</td>
                      <td>{{ item.expense_category_data.name }}</td>
                      <td>{{ item.amount }}</td>
                      <td>{{ formatDate(item.date) }}</td>
                      <td>{{ item.description }}</td>

                      <td
                        style="
                          display: flex;
                          align-items: center;
                          justify-content: flex-start;
                          gap: 10px;
                        "
                      >
                        <router-link
                          :to="'/expense/edit/' + item.id"
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
