<script>
import Layout from "../Layout.vue";
import axios from "axios";
import Loader from '../../loader/Loader.vue'

export default {
  components: {
    Layout,
    Loader
  },

  data() {
    return {
      dataTable: null,
      category: [],
      loading: true,
    };
  },

  mounted() {
    this.getCategories();
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
    getCategories() {
      axios.get("http://localhost:8000/api/all-category").then((response) => {
        console.log(response.data);
        this.loading = false;
        this.category = response.data;

        // After setting the data, initialize DataTables
        this.initDataTable();
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
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item">
                    <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Category
                  </li>
                </ol>
              </nav>
            </div>
            <div class="ms-auto">
              <div class="btn-group">
                <router-link to="/add-category">
                  <button
                    type="button"
                    class="btn btn-primary"
                    style="margin-left: 30px"
                  >
                    Add Category
                  </button>
                </router-link>
              </div>
            </div>
          </div>
          <!--end breadcrumb-->
          <h6 class="mb-0 text-uppercase">Manage Your Category</h6>

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
                      <th>Category</th>
                      <th>Category Slug</th>
                      <th>Created On</th>
                      <th>Status</th>

                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in this.category" :key="index">
                      <td>{{ item.name }}</td>
                      <td>{{ item.slug }}</td>
                      <td>{{ item.created_at }}</td>

                      <td>{{ item.status }}</td>
                      <td
                        style="
                          display: flex;
                          align-items: center;
                          justify-content: flex-start;
                          gap: 10px;
                        "
                      >
                        <button
                          type="button"
                          class="btn btn-outline-primary px-5"
                        >
                          <i class="bx bx-pencil mr-1"></i>Edit
                        </button>
                        <button
                          type="button"
                          class="btn btn-outline-danger px-5"
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
