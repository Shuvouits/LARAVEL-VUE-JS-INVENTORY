<script>


import Header from '../components/Header.vue'
import Sidebar from '../components/Sidebar.vue';

export default {

 

  components: {
    Header,
    Sidebar
  }



};
</script>


<template>
  <div>

        <div id="global-loader">
            <div class="whirly-loader"></div>
        </div>

        <div class="main-wrapper">
             <Header />
             <Sidebar />
        </div>

   

   



  </div>
</template>



