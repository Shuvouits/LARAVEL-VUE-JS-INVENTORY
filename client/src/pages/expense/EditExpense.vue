<script>
import Layout from "../Layout.vue";
import "select2";
import Swal from "sweetalert2";
import axios from "axios";

export default {
  components: {
    Layout,
  },

  data() {
    return {
      selectedDate: null,
      expenseData: [],
      expense_id: "",  // Make sure this is initialized correctly
      date: "",
      amount: '',
      description: ''
    };
  },

  mounted() {

    this.getExpense(this.$route.params.id);


    this.getExpenseCategory();


  },

  methods: {

    getExpense(id) {
      const token = this.$store.state.token;

      axios
        .get(`https://appinventory.shuvobhowmik.xyz/api/expense/edit/${id}`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.expense_id = response.data.expense_id
          this.date = response.data.date
          this.amount = response.data.amount
          this.description = response.data.description
          
        });

        this.$nextTick(() => {
      $(this.$refs.selectElement).select2().on('change', () => {
        this.expense_id = $(this.$refs.selectElement).val();
      });

      $(this.$refs.selectElement1).select2();
    });

        


    },

    getExpenseCategory() {
      const token = this.$store.state.token;
      axios
        .get("https://appinventory.shuvobhowmik.xyz/api/all-category-expense", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          this.loading = false;
          this.expenseData = response.data;
        });
    },

    sendData() {
      const data = {
        expense_id: this.expense_id,  // Ensure the correct data is sent
        date: this.date,
        amount: this.amount,
        description: this.description
      };

      const token = this.$store.state.token;

      console.log(this.expense_id);

      axios
        .post(`https://appinventory.shuvobhowmik.xyz/api/update-expense/${this.$route.params.id}`, data, {
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

          this.$router.push("/expense");
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

  destroyed() {
    $(this.$refs.selectElement).select2("destroy");
    $(this.$refs.selectElement1).select2("destroy");
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
                  Expense
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
        <div>

          <router-link to="/sales"
          ><h6 class="mb-0 text-uppercase">Expense History</h6></router-link
        >

          <router-link to="/add-expense">
                <button type="button" class="btn btn-primary">
                  Add Expense
                </button>
              </router-link>

        </div>
        

        <hr />
        <div class="card">
          <div class="card-body p-4">
            <h5 class="mb-4">Update Expense</h5>
            <form class="row g-3" @submit.prevent="sendData">
              <div class="col-md-6">
                <label for="single-select-field" class="form-label"
                  >Expense Name</label
                >
                <select
                  class="form-select custom-select"
                  id="single-select-field"
                  ref="selectElement"
                  v-model="expense_id"
                  required
                >
                  <option v-for="(item, index) in expenseData" :key="index" :value="item.id">{{ item.name }}</option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="input6" class="form-label">Date</label>
                <input
                  type="date"
                  class="form-control"
                  id="input6"
                  placeholder="Enter your Date"
                  v-model="date"
                  required
                />
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Amount</label>
                <div class="position-relative input-icon">
                  <input
                    type="price"
                    class="form-control"
                    id="input14"
                    placeholder="Enter your amount"
                    v-model="amount"
                    required
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-dollar-circle"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-12">
                <label for="input11" class="form-label">Description</label>
                <textarea
                  class="form-control"
                  id="input11"
                  placeholder="Description ..."
                  v-model="description"
                  rows="3"
                  required
                ></textarea>
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
