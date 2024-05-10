<script>
import Layout from "./Layout.vue";

export default {
  components: {
    Layout,
  },
  data() {
    return {
      dataTable: null,
      visible: true,
    };
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
    initDataTable() {
      this.dataTable = $("#example").DataTable();
    },
    destroyDataTable() {
      if (this.dataTable) {
        this.dataTable.destroy();
        this.dataTable = null;
      }
    },

    low() {
      this.visible = true; // Toggles the state between true and false
    },

    out() {
      this.visible = false; // Toggles the state between true and false
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
          <div class="breadcrumb-title pe-3">Tables</div>
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                  <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Low Stock
                </li>
              </ol>
            </nav>
          </div>
          <div class="ml-auto">
            <div class="btn-group">
              <button
                type="button"
                @click="low"
                class="btn btn-primary"
                style="margin-left: 30px"
              >
                Low Stock
              </button>
              <button
                type="button"
                @click="out"
                class="btn btn-primary"
                style="margin-left: 30px"
              >
                Out Of Stock
              </button>
            </div>
          </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Manage Your Low Stock</h6>

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
                    <th>Product</th>
                    <th>Category</th>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>Qty Alert</th>

                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    

                  <tr v-if="visible">
                    <td>Low Stock</td>
                    <td>Category Data</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>

                    <td>2011/04/25</td>
                    <td>$320,800</td>
                  </tr>

                  <tr v-else>
                    <td>Out Of Stock</td>
                    <td>Category Data</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>

                    <td>2011/04/25</td>
                    <td>$320,800</td>
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
</template>
