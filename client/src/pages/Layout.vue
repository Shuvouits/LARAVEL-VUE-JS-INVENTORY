<script>
import Header from "../components/Header.vue";
import Sidebar from "../components/Sidebar.vue";

export default {
  components: {
    Header,
    Sidebar,
  },
};
</script>

<template>
  <div class="wrapper">
    <Sidebar />
    <Header />

    <router-view />
  </div>
</template>