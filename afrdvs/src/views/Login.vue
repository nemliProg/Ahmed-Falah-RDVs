<template>
  <div class="formContainer">
    <h1>Login</h1>
    <form>
      <input type="text" placeholder="Write Your Reference" v-model="reference">
      <button>Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  name : "Login",
  data() {
    return {
      reference : ""
    }
  },
  methods : {
    
  }
}
</script>

<style lang="scss">
  .formContainer{
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