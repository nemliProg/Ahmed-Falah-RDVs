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
          
        }).catch(err => console.log(err));
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
        width: 400px;
        margin: auto;
        font-size: 1rem;
        padding: 3px 10px;
        border-radius: 10px;
        outline: none;
        border: 0.5px solid green;
        font-family: inherit;
      }
      button{
        width: 100px;
        margin: auto;
        height: min-content;
        font-size: 1.1rem;
        border-radius: 5px;
        border: none;
        padding: 5px 10px;
        font-family: inherit;
        background-color: $primary-color;
        color: white;
        cursor: pointer;
      }
    }
  }
</style>