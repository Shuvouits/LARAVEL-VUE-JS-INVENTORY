<script>
import Header from "../components/Header.vue";
import Sidebar from "../components/Sidebar.vue";

export default {
  data(){
    return{
      sidebarToggle: false
    }

  },

  components: {
    Header,
    Sidebar,
    
  },

  methods: {
    handleSidebar() {
      this.sidebarToggle = !this.sidebarToggle
    }
  }
};
</script>

<template>
  <div :class="sidebarToggle ? 'wrapper toggled' : 'wrapper' " >
    <Sidebar :handleSidebar="handleSidebar"  />
    <Header :handleSidebar="handleSidebar" />

    <router-view />
  </div>
</template>