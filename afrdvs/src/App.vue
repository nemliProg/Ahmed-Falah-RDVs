<template>

  <Nav :setCurrentState="setCurrentState" :currentState="state" />
  <router-view :setCurrentState="setCurrentState" />
  <Footer />
</template>

<script>
  import Nav from './components/Nav.vue'
  import Footer from './components/Footer.vue'
  
  export default {
    name : "App",
    components : {
      Nav,
      Footer
    },
    data() {
      return {
        id : 0,
        name : "",
        state:undefined
      }
    },
    methods : {
      setCurrentState(data){
        this.state = data;
      }
    }
  }
</script>

<style lang="scss">
  *{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    
  }
  #app{
    position: relative;
    height: 100vh;
  }
</style>
