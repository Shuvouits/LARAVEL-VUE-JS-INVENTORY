<script>

import $ from 'jquery';
import 'datatables.net';

import Layout from './Layout.vue'

import  '../assets/dataTable.css'
import  '../assets/dataTable.js'

export default{
    components : {
        Layout,
    },

    mounted() {
    $(this.$refs.dataTable).DataTable({
      // DataTables options here
      // Example:
      data: this.tableData,
      columns: [
        { title: "Product", data: "product" },
        { title: "Category", data: "category" },
         { title: "Brand", data: "brand" },
        { title: "Price", data: "price" },
         { title: "Action", data: "action" },
      
        // Add more columns as needed
      ]
    });
  },


   data() {
    return {
      tableData: [
        { product : "product", category : "category", brand : 'brand', price : 'price', action : 'action' },
        
        // Add more data as needed
      ]
    };
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
					<div class="breadcrumb-title pe-3">Tables</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Data Table</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
                            <router-link to="/add-product">
                                <button type="button" class="btn btn-primary">Add Product</button>

                            </router-link>
							
							
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">DataTable Example</h6>
                
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							

                            <table ref="dataTable" class="table table-striped table-bordered" style="width:100%">
							
							</table>


						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!--end page wrapper -->

</div>




</template>