<template>
  <div class="formContainer">
    <h1>Login</h1>
    <form @submit.prevent="login">
      <input type="text" placeholder="Write Your Reference" v-model="reference">
      <button @click="addd">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  name : "Login",
  props : {
    reload_nav : Number,
    setCurrentState: Function
  },
  data() {
    return {
      reference : ""
    }
  },
  methods : {
    addd(){
      
    },
    login() {
      if(this.reference != ""){
        fetch("http://localhost/Ahmed-Falah-RDVs/usersApi/login",{
          method: 'POST',
          body: JSON.stringify({
              ref : this.reference
          })
        })
        .then( response => response.json() )
        .then( json => {
          console.log(json.ref[0])
          if (json.ref[0] !== '$') {
            this.setCurrentState({role: "admin", id: json.id});
            localStorage.setItem("ref","admin");
            localStorage.setItem("id",json.id);
            this.$router.push({name: 'dashboard'});
          } else {
            this.setCurrentState({role: "user", id: json.id});
            localStorage.setItem("ref",json.ref);
            localStorage.setItem("id",json.id);
            this.$router.push({name: 'rdvs'});
          }
          
        });
      }
    }
  }
}
</script>

<style lang="scss">
  .formContainer {
    font-family: $tenor;
    display: flex;
    gap: 30px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 70vh;
    form{
      display: flex;
      flex-direction: column;
      width: 100%;
      gap: 10px;
      font-family: inherit;
      input[type="text"]{
        width: 50%;
        margin: auto;
        font-size: 1.3rem;
        padding: 3px 10px;
        border-radius: 10px;
        outline: none;
        border: 0.5px solid green;
        font-family: inherit;
      }
      button{
        width: 30%;
        margin: auto;
        font-size: 1.3rem;
        border-radius: 10px;
        border: none;
        padding: 10px;
        font-family: inherit;
      }
    }
  }
</style>