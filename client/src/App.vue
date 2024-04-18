
<template>
  <div id="app">
    <router-link to="/home">Home</router-link> |
    <router-link to="/about">About</router-link> | 
    <router-link to="/">Dashboard</router-link>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  
};
</script>