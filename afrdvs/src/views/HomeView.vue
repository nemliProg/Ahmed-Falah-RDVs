<template>
  <h1>Home Page</h1>
</template>

<script>


export default {
  name: 'Home',
  components: {
    
  },
  props :["id"],
  mounted(){
    if(this.id === 0) {
      this.$router.push("/about");
    }
  }
}
</script>

<style lang="scss">

</style>
