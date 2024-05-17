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
      name: '',
    };
  },

  mounted() {
    this.getExpense(this.$route.params.id);
  },

  methods: {

    getExpense(id) {
      const token = this.$store.state.token;

      axios
        .get(`http://localhost:8000/api/expense-category/edit/${id}`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.name = response.data.name
          
        });
    },


    sendData() {
      const data = {
        // Your data to send to the API
        name: this.name,
      };

      const token = this.$store.state.token;

      axios
        .post(`http://localhost:8000/api/update-category-expense/${this.$route.params.id}`, data, {
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

          this.$router.push("/category-expense");
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
                  Edit Expense Category
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
        <router-link to="/category-expense"
          ><h6 class="mb-0 text-uppercase">Expense History</h6></router-link
        >

        <hr />
        <div class="card col-md-8">
          <div class="card-body p-4">
            <h5 class="mb-4">Edit Expense</h5>
            <form class="row g-3" @submit.prevent="sendData">
            
               <div class="col-md-12">
                <label for="expense-name" class="form-label">Expense Name</label>
                <div class="position-relative input-icon">
                  <input
                    type="price"
                    class="form-control"
                    v-model = "name"
                    id="expense-name"
                    placeholder="Expense Name"
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


