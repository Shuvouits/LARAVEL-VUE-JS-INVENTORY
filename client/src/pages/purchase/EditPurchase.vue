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
      supplier: [],
      product: [],
      supplier_id : "",
      product_id : "",
      date : "",
      status : "Ordered",
      qty : "",
      g_total : "",
      p_amount : "",
      amount_per : "",
    

    };
  },

  watch: {

    qty() {
      this.calculateGrandTotal();
    },

    amount_per(val) {
      this.calculateGrandTotal();
    },

    g_total(val) {
      this.calculateGrandTotal();
    },
    p_amount(val) {
      this.calculateDueAmount();
    },

  

  },

  computed: {

    d_amount() {
      return this.calculateDueAmount();
    },


  },

  mounted() {

    this.getPurchase(this.$route.params.id);

    this.getSupplier();
    this.getProduct();

    this.$nextTick(() => {
      $(this.$refs.selectElement).select2().on('change', () => {
        this.supplier_id = $(this.$refs.selectElement).val();
      });

      $(this.$refs.selectElement1).select2().on('change', () => {
        this.product_id = $(this.$refs.selectElement1).val();
      });

      
    });

   
  },

  methods: {

    getPurchase(id) {
      const token = this.$store.state.token;

      axios
        .get(`https://appinventory.shuvobhowmik.xyz/api/purchase/edit/${id}`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.supplier_id = response.data.supplier_id
          this.product_id = response.data.product_id
          this.date = response.data.date
          this.status = response.data.status
          this.qty = response.data.qty
          this.g_total = response.data.g_total
          this.p_amount = response.data.p_amount
          this.amount_per = response.data.amount_per
        
          
          
        });

        this.$nextTick(() => {
      $(this.$refs.selectElement).select2().on('change', () => {
        this.expense_id = $(this.$refs.selectElement).val();
      });

      $(this.$refs.selectElement1).select2();
    });

        


    },

    getSupplier() {
      const token = this.$store.state.token;
      axios
        .get("https://appinventory.shuvobhowmik.xyz/api/all-supplier", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          this.loading = false;
          this.supplier = response.data;
        });
    },

    getProduct() {
      const token = this.$store.state.token;
      axios
        .get("https://appinventory.shuvobhowmik.xyz/api/all-product", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
         // console.log(response.data);
          this.loading = false;
          this.product = response.data;
        });
    },

    sendData() {
      const data = {
        supplier_id: this.supplier_id, // Ensure the correct data is sent
        product_id : this.product_id,
        date: this.date,
        status : this.status,
        qty : this.qty,
        g_total : this.g_total,
        p_amount : this.p_amount,
        d_amount: this.d_amount,
        amount_per: this.amount_per
      };

      const token = this.$store.state.token;

      console.log(this.expense_id);

      axios
        .post(`https://appinventory.shuvobhowmik.xyz/api/update-purchase/${this.$route.params.id}`, data, {
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

          this.$router.push("/purchase");
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

    calculateGrandTotal() {
      let amount_per = parseFloat(this.amount_per) || 0;
      let qty = parseFloat(this.qty) || 0;
      this.g_total = amount_per * qty;
    },

    calculateDueAmount() {
      let g_total = parseFloat(this.g_total) || 0;
      let p_amount = parseFloat(this.p_amount) || 0;
      return g_total - p_amount;
    }


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
                  Purchased
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

          <router-link to="/sales"
          ><h6 class="mb-0 text-uppercase">Purchased History</h6></router-link
        >

          <router-link to="/add-purchased">
                <button type="button" class="btn btn-primary">
                  Add Purchased
                </button>
              </router-link>
        </div>
       

        <hr />
        <div class="card">
          <div class="card-body p-4">
            <h5 class="mb-4">Add Purchased</h5>

            <form class="row g-3" @submit.prevent="sendData">
              <div class="col-md-6">
                <label for="single-select-field" class="form-label" id="supplier"
                  >Supplier Name</label
                >

                <select
                  class="form-select custom-select"
                  id="supplier"
                  ref="selectElement"
                  v-model="supplier_id"
                >

                  <option v-for="(item, index) in supplier" :key="index" :value="item.id">{{ item.name }}</option>
                 
                </select>
              </div>

              <div class="col-md-6">
                <label for="single-select-field" class="form-label"
                  >Product Name</label
                >

                <select
                  class="form-select custom-select"
                  id="single-select-field"
                  ref="selectElement1"
                  v-model = "product_id"
                >
                <option v-for="(item, index) in product" :key="index" :value="item.id">{{ item.name }}</option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="input6" class="form-label">Date</label>
                <input
                  type="date"
                  class="form-control"
                  id="input6"
                  placeholder="Date of Birth"
                  v-model = 'date'
                />
              </div>

              <div class="col-md-6">
                <label for="input7" class="form-label">Status</label>
                <select id="input7" v-model="status" class="form-select">
                 
                  <option value="Received">Received</option>
                  <option value="Ordered">Ordered</option>
                  <option value="Return">Return</option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Quantity</label>
                <div class="position-relative input-icon">
                  <input
                    type="number"
                    class="form-control"
                    id="input14"
                    placeholder="Enter quantity"
                    v-model="qty" 
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Amount / Per Piece</label>
                <div class="position-relative input-icon">
                  <input
                    type="number"
                    class="form-control"
                    id="input14"
                    placeholder="Enter quantity"
                    v-model="amount_per"
                    required 
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Grand Total</label>
                <div class="position-relative input-icon">
                  <input
                    type="number"
                    class="form-control"
                    id="input14"
                    v-model = 'g_total'
                    placeholder="Enter Grand total"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Paid Amount</label>
                <div class="position-relative input-icon">
                  <input
                    type="price"
                    class="form-control"
                    id="input14"
                    placeholder="Enter paid amount"
                    v-model="p_amount"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Due Amount</label>
                <div class="position-relative input-icon">
                  <input
                    type="price"
                    class="form-control"
                    id="input14"
                    placeholder="Enter due amount"
                    v-model = "d_amount"
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
