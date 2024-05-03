<script>
import Layout from "../pages/Layout.vue";
import Chart from '../components/Chart.vue';


export default {


  components: {
    Layout,
    Chart,


  },



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
										<h4 class="my-1">$4805</h4>
										<p class="mb-0 font-13 text-success"><i class="bx bxs-up-arrow align-middle"></i>$34 from last week</p>
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
										<h4 class="my-1">8.4K</h4>
										<p class="mb-0 font-13 text-danger"><i class="bx bxs-down-arrow align-middle"></i>$24 from last week</p>
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
										<h4 class="my-1">59K</h4>
										<p class="mb-0 font-13 text-success"><i class="bx bxs-up-arrow align-middle"></i>$34 from last week</p>
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
										<h4 class="my-1">34.46%</h4>
										<p class="mb-0 font-13 text-danger"><i class="bx bxs-down-arrow align-middle"></i>12.2% from last week</p>
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
                  <h5 class="mb-0 text-white">9526</h5>
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
                  <p class="mb-0">Total Orders</p>
                  <p class="mb-0 ms-auto">
                    +4.2%<span><i class="bx bx-up-arrow-alt"></i></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">$8323</h5>
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
                  <p class="mb-0">Total Revenue</p>
                  <p class="mb-0 ms-auto">
                    +1.2%<span><i class="bx bx-up-arrow-alt"></i></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">6200</h5>
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
                  <p class="mb-0">Visitors</p>
                  <p class="mb-0 ms-auto">
                    +5.2%<span><i class="bx bx-up-arrow-alt"></i></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 bg-gradient-moonlit">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">5630</h5>
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
                  <p class="mb-0">Messages</p>
                  <p class="mb-0 ms-auto">
                    +2.2%<span><i class="bx bx-up-arrow-alt"></i></span>
                  </p>
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
                
                <Chart />



              </div>
            </div>
          </div>

          <div class="col-12 col-lg-6 col-xl-6 d-flex">
            <div class="card radius-10 w-100">
              <div class="card-header border-bottom bg-transparent">
                <div class="d-flex align-items-center">
                  <div>
                    <h5 class="mb-0">Recent Products</h5>
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
                  <tr>
                    <td>#897656</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="recent-product-img">
                          <img
                            src="../../assets/images/icons/chair.png"
                            alt=""
                          />
                        </div>
                        <div class="ms-2">
                          <h6 class="mb-1 font-14">Light Blue Chair</h6>
                        </div>
                      </div>
                    </td>
                    <td>20000</td>
                    
                  </tr>
                  
                </tbody>
              </table>
            </div>



             
            </div>
          </div>
        </div>
        <!--End Row-->

        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div>
                <h5 class="mb-0">Expired Products</h5>
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
            <hr />
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead class="table-light">
                  <tr>
                    <th>Order id</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Manufactured Date</th>
                    <th>expired Date</th>
                  
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#897656</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="recent-product-img">
                          <img
                            src="../../assets/images/icons/chair.png"
                            alt=""
                          />
                        </div>
                        <div class="ms-2">
                          <h6 class="mb-1 font-14">Light Blue Chair</h6>
                        </div>
                      </div>
                    </td>
                    <td>Brooklyn Zeo</td>
                    <td>12 Jul 2020</td>
                    <td>$64.00</td>
                  
                    <td>
                      <div class="d-flex order-actions">
                        <a href="javascript:;" class=""
                          ><i class="bx bx-cog"></i
                        ></a>
                        <a href="javascript:;" class="ms-4"
                          ><i class="bx bx-down-arrow-alt"></i
                        ></a>
                      </div>
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
</template>



