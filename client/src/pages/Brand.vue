<script>
import Layout from './Layout.vue'

export default {
    components: {
        Layout,
    },
    data() {
        return {
            dataTable: null
        };
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            vm.initDataTable();
        });
    },
    beforeRouteLeave(to, from, next) {
        this.destroyDataTable();
        next();
    },
    methods: {
        initDataTable() {
            this.dataTable = $('#example').DataTable();
        },
        destroyDataTable() {
            if (this.dataTable) {
                this.dataTable.destroy();
                this.dataTable = null;
            }
        }
    }
}
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
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Brand</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <div class="btn-group">

                            <router-link to="/add-brand">

                                <button
                type="button"
               
                class="btn btn-primary"
                style="margin-left: 30px"
              >
                Add Brand
              </button>
                           
                            

                            </router-link>

                           
                            
                        </div>
                    </div>
                </div>
                <!--end breadcrumb-->
                <h6 class="mb-0 text-uppercase">Manage Your Brand</h6>
                
                
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            

                          <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Brand</th>
                                        <th>Logo</th>
                                        <th>Created On</th>
                                        <th>Status</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
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