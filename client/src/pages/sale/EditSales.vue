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
      customer: [],
      product: [],
      customer_id: "",
      product_id: "",
      date: "",
      status: "",
      quantity: "",
      g_total: "",
      p_amount: "",
      amount_per : "",
      quantity : "",
      return_qty : "",
      product_price : ""
    };
  },

  watch: {
    quantity(val) {
      this.calculateGrandTotal();
    },

    amount_per(val) {
      this.calculateGrandTotal();
    },

    g_total(val) {
      this.calculateDueAmount();
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
    this.getSales(this.$route.params.id);

    this.getCustomer();
    this.getProduct();

    this.$nextTick(() => {
      $(this.$refs.selectElement)
        .select2()
        .on("change", () => {
          this.product_id = $(this.$refs.selectElement).val();
        });

      $(this.$refs.selectElement1)
        .select2()
        .on("change", () => {
          this.customer_id = $(this.$refs.selectElement1).val();
        });
    });
  },

  methods: {
    getSales(id) {
      const token = this.$store.state.token;

      axios
        .get(`https://appinventory.shuvobhowmik.xyz/api/sales/edit/${id}`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.loading = false;
          this.customer_id = response.data.customer_id;
          this.product_id = response.data.product_id;
          this.date = response.data.date;
          this.status = response.data.status;
          this.quantity = response.data.quantity;
          this.g_total = response.data.g_total;
          this.p_amount = response.data.p_amount;
          this.amount_per = response.data.product.price;
          this.return_qty = response.data.return_qty;
          this.product_price = response.data.product.price
        
        });

       

       

      /* this.$nextTick(() => {
      $(this.$refs.selectElement).select2().on('change', () => {
        this.expense_id = $(this.$refs.selectElement).val();
      });

      $(this.$refs.selectElement1).select2();
    }); */
    },

    getCustomer() {
      const token = this.$store.state.token;
      axios
        .get("https://appinventory.shuvobhowmik.xyz/api/all-customer", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          this.loading = false;
          this.customer = response.data;
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
        customer_id: this.customer_id, // Ensure the correct data is sent
        product_id: this.product_id,
        date: this.date,
        status: this.status,
        quantity: this.quantity,
        g_total: this.g_total,
        p_amount: this.p_amount,
        d_amount: this.d_amount,
      };

      const token = this.$store.state.token;

      axios
        .post(
          `https://appinventory.shuvobhowmik.xyz/api/update-sales/${this.$route.params.id}`,
          data,
          {
            headers: {
              "Content-Type": "application/json",
              Authorization: `Bearer ${token}`,
            },
          }
        )
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

          this.$router.push("/sales");
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
      let quantity = parseFloat(this.quantity) || 0;
      this.g_total = amount_per * quantity;
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
                  Sales
                </li>
              </ol>
            </nav>
          </div>
          <div class="ms-auto">
            <div class="btn-group"></div>
          </div>
        </div>
        <!--end breadcrumb-->
        <div
          style="
            display: flex;
            align-items: center;
            justify-content: space-between;
          "
        >
          <router-link to="/sales"
            ><h6 class="mb-0 text-uppercase">Sales History</h6></router-link
          >

          <router-link to="/sales">
            <button type="button" class="btn btn-primary">Go Sales</button>
          </router-link>
        </div>

        <hr />
        <div class="card">
          <div class="card-body p-4">
            <h5 class="mb-4">Update Sales</h5>

            <form class="row g-3" @submit.prevent="sendData">
              <div class="col-md-6">
                <label
                  for="single-select-field"
                  class="form-label"
                  id="supplier"
                  >Product Name</label
                >

                <select
                  class="form-select custom-select"
                  id="supplier"
                  ref="selectElement"
                  v-model="product_id"
                >
                  <option
                    v-for="(item, index) in product"
                    :key="index"
                    :value="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="single-select-field" class="form-label"
                  >Customer Name</label
                >

                <select
                  class="form-select custom-select"
                  id="single-select-field"
                  ref="selectElement1"
                  v-model="customer_id"
                >
                  <option
                    v-for="(item, index) in customer"
                    :key="index"
                    :value="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="input6" class="form-label">Date</label>
                <input
                  type="date"
                  class="form-control"
                  id="input6"
                  placeholder="Date of Birth"
                  v-model="date"
                />
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Quantity</label>
                <div class="position-relative input-icon">
                  <input
                    type="number"
                    class="form-control"
                    id="input14"
                    placeholder="Enter quantity"
                    v-model="quantity"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Return Quantity</label>
                <div class="position-relative input-icon">
                  <input
                    type="number"
                    class="form-control"
                    id="input14"
                    placeholder="Enter quantity"
                    v-model="return_qty"
                    disabled 
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="input14" class="form-label">Product Price</label>
                <div class="position-relative input-icon">
                  <input
                    type="number"
                    class="form-control"
                    id="input14"
                    placeholder="Enter quantity"
                    v-model="product_price"
                    disabled 
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
                    v-model="g_total"
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
                    v-model="d_amount"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
                  ></span>
                </div>
              </div>

              <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select id="status" v-model="status" class="form-select">
                  <option value="Paid">Paid</option>
                  <option value="UnPaid">UnPaid</option>
                 
                </select>
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
