<template>
  <h1>Dashboard</h1>
</template>

<script>
export default {
  name:'Dashboard',
  mounted() {
    // if (!) {
    //   this.$router.push({name: 'login'})
    // }
    let bool = window.localStorage.getItem("ref");
    if (bool === null) {
      this.$router.push({name: 'login'})
    }
    
  }
}
</script>

<style>

</style>