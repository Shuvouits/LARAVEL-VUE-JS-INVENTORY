<script>
import Layout from "../Layout.vue";
import "select2";

export default {
  components: {
    Layout,
  },

  mounted() {
    $(this.$refs.selectElement).select2();
    $(this.$refs.selectElement1).select2();
  },
  destroyed() {
    $(this.$refs.selectElement).select2("destroy");
    $(this.$refs.selectElement1).select2("destroy");
  },

  data() {
    return {
      selectedDate: null,
    };
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
                  Add Expense Category
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
        <router-link to="/sales"
          ><h6 class="mb-0 text-uppercase">Expense History</h6></router-link
        >

        <hr />
        <div class="card">
          <div class="card-body p-4">
            <h5 class="mb-4">Create Expense</h5>
            <form class="row g-3">
            
               <div class="col-md-12">
                <label for="input14" class="form-label">Expense Name</label>
                <div class="position-relative input-icon">
                  <input
                    type="price"
                    class="form-control"
                    id="input14"
                    placeholder="Last Name"
                  />
                  <span class="position-absolute top-50 translate-middle-y"
                    ><i class="bx bx-user"></i
                  ></span>
                </div>
              </div>

             

           

            

              <div class="col-md-12">
                <label for="input11" class="form-label">Description</label>
                <textarea
                  class="form-control"
                  id="input11"
                  placeholder="Address ..."
                  rows="3"
                ></textarea>
              </div>

              <div class="col-md-12">
                <div class="d-md-flex d-grid align-items-center gap-3">
                  <button type="button" class="btn btn-primary px-4">
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


