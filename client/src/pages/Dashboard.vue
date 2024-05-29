<script>
import Layout from "../pages/Layout.vue";
import Chart from '../components/Chart.vue';
import axios from "axios";


export default {

  data(){

    return{
      'total_category' : "",
      'total_product' : "",
      'total_purchase' : "",
      'monthly_purchase' : '',
      'total_sale' : "",
      'monthly_sale' : "",
      'total_sale_due' : "",
      'total_purchase_due' : "",
      'monthly_sales_due' : "",
      'monthly_purchase_due' : "",
      'total_expense' : "",
      "monthly_expense" : "",
      'total_customer' : "",
      "total_supplier" : "",
      'month_wise_sale' : [],
      'month_wise_purchase' : [],
      'month_wise_expense' : [],
      

    }

  },


  components: {
    Layout,
    Chart,


  },

  computed: {
    currentDate() {
      const options = { year: "numeric", month: "long" };
      return this.date.toLocaleDateString(undefined, options);
    },
  },

  mounted() {
    this.getData();
    
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

    getData() {
      const token = this.$store.state.token;
      axios
        .get("http://localhost:8000/api/dashboard", {
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          this.loading = false;
          
          this.total_category = response.data.total_category;
          this.total_product = response.data.total_product;
          this.total_sale = response.data.total_sale;
          this.total_sale_due = response.data.total_sale_due;
          this.total_purchase_due = response.data.total_purchase_due;
          this.monthly_sales_due = response.data.monthly_sales_due;
          this.monthly_purchase_due = response.data.monthly_purchase_due;
    
          this.monthly_sale = response.data.monthly_sale,
          this.total_expense = response.data.total_expense,
          this.monthly_expense = response.data.monthly_expense,
          this.total_product = response.data.total_product,
          this.total_category = response.data.total_category,
          this.total_customer = response.data.total_customer,
          this.total_supplier = response.data.total_supplier,
        
          this.month_wise_sale = response.data.month_wise_sales,

          this.month_wise_purchase = response.data.month_wise_purchase,
          this.month_wise_expense = response.data.month_wise_expense,
          this.top_selling_product = response.data.top_selling_product
         
        });

      

        
    },

   

  }



};
</script>


<template>
  <div>
    <Layout />
	
    <div class="page-wrapper">
      <div class="page-content">

        <!---Start Row-->

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
                    
										<p class="mb-0 text-secondary">Total Purchase Due</p>
                   <!----<h1>Your phone: {{ this.$store.state.phone }}</h1>  -->
										<h4 class="my-1">${{ total_purchase_due }}</h4>
										<p class="mb-0 font-13 text-success"><i class="bx bxs-up-arrow align-middle"></i>${{ monthly_purchase_due }} from last Month</p>
									</div>
									<div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-burning"><i class="bx bxs-wallet"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Total Sale Due</p>
										<h4 class="my-1">${{ total_sale_due }}</h4>
										<p class="mb-0 font-13 text-danger"><i class="bx bxs-down-arrow align-middle"></i>${{ monthly_sales_due }} from last Month</p>
									</div>
									<div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-voilet"><i class="bx bxs-group"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Total Sale Amount</p>
										<h4 class="my-1">${{ total_sale }}</h4>
										<p class="mb-0 font-13 text-success"><i class="bx bxs-up-arrow align-middle"></i>${{ monthly_sale }} from last Month</p>
									</div>
									<div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-branding"><i class="bx bxs-binoculars"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-secondary">Total Expense Amount</p>
										<h4 class="my-1">${{ total_expense }}</h4>
										<p class="mb-0 font-13 text-danger"><i class="bx bxs-down-arrow align-middle"></i>${{monthly_expense }} from last Month</p>
									</div>
									<div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-kyoto"><i class="bx bx-line-chart-down"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

        <!---End Row --->



        <!--Start Row--->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
          <div class="col">
            <div class="card radius-10 bg-gradient-deepblue">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ total_product }}</h5>
                  <div class="ms-auto">
                    <i class="bx bx-cart fs-3 text-white"></i>
                  </div>
                </div>
                <div
                  class="progress my-2 bg-opacity-25 bg-white"
                  style="height: 4px"
                >
                  <div
                    class="progress-bar bg-white"
                    role="progressbar"
                    style="width: 55%"
                    aria-valuenow="25"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
                <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Total Product</p>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ total_category }}</h5>
                  <div class="ms-auto">
                    <i class="bx bx-dollar fs-3 text-white"></i>
                  </div>
                </div>
                <div
                  class="progress my-2 bg-opacity-25 bg-white"
                  style="height: 4px"
                >
                  <div
                    class="progress-bar bg-white"
                    role="progressbar"
                    style="width: 55%"
                    aria-valuenow="25"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
                <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Total Category</p>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ total_customer }}</h5>
                  <div class="ms-auto">
                    <i class="bx bx-group fs-3 text-white"></i>
                  </div>
                </div>
                <div
                  class="progress my-2 bg-opacity-25 bg-white"
                  style="height: 4px"
                >
                  <div
                    class="progress-bar bg-white"
                    role="progressbar"
                    style="width: 55%"
                    aria-valuenow="25"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
                <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Total Customers</p>
                
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 bg-gradient-moonlit">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ total_supplier }}</h5>
                  <div class="ms-auto">
                    <i class="bx bx-envelope fs-3 text-white"></i>
                  </div>
                </div>
                <div
                  class="progress my-2 bg-opacity-25 bg-white"
                  style="height: 4px"
                >
                  <div
                    class="progress-bar bg-white"
                    role="progressbar"
                    style="width: 55%"
                    aria-valuenow="25"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
                <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Total Suppliers</p>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--end row-->

     
         <!--start row -->
        <div class="row">
          <div class="col-12 col-lg-6 col-xl-6 d-flex">
            <div class="card radius-10 overflow-hidden w-100">
              <div class="card-body">
                <p>Purchase & Sales</p>
                
                <Chart :month_wise_sale="month_wise_sale" :month_wise_purchase="month_wise_purchase" :month_wise_expense="month_wise_expense" />



              </div>
            </div>
          </div>

          <div class="col-12 col-lg-6 col-xl-6 d-flex">
            <div class="card radius-10 w-100">
              <div class="card-header border-bottom bg-transparent">
                <div class="d-flex align-items-center">
                  <div>
                    <h5 class="mb-0">Top selling products in this month</h5>
                  </div>
                  <div class="dropdown options ms-auto">
                    <div
                      class="dropdown-toggle dropdown-toggle-nocaret"
                      data-bs-toggle="dropdown"
                    >
                      <i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="javascript:;">Action</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:;"
                          >Another action</a
                        >
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:;"
                          >Something else here</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

               <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Price</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in this.top_selling_product" :key="index">
                    <td>{{ index+1 }}</td>

                    <td>
                        <img
                          v-if="item.product.avatar"
                          :src="'http://localhost:8000/images/' + item.product.avatar"
                          style="width: 40px; height: 40px; border-radius: 5px; "
                        />

                        <span v-else>
                          <svg
                            height="40"
                            viewBox="0 0 32 32"
                            width="40"
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
                        <span style="margin-left: 25px">{{ item.product.name }}</span>
                      </td>

                   
                    <td>{{ item.product.price }}</td>
                    
                  </tr>
                  
                </tbody>
              </table>
            </div>



             
            </div>
          </div>
        </div>
        <!--End Row-->

       
      </div>
    </div>
  </div>
</template>



