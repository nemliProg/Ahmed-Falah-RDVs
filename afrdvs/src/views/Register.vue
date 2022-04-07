<template>
  <div class="RegisterContainer">
    <h1>Register</h1>
    <form @submit.prevent="register">
      <div class="input-container ic1">
        <input
          id="nom"
          class="input"
          type="text"
          placeholder=" "
          v-model="nom"
        />
        <div class="cut cut-short"></div>
        <label for="nom" class="placeholder">nom</label>
      </div>
      <div class="input-container ic2">
        <input
          id="prenom"
          class="input"
          type="text"
          placeholder=" "
          v-model="prenom"
        />
        <div class="cut"></div>
        <label for="prenom" class="placeholder">prenom</label>
      </div>
      <div class="input-container ic2">
        <input
          id="age"
          class="input"
          type="number"
          min="1"
          placeholder=" "
          v-model="age"
        />
        <div class="cut cut-short"></div>
        <label for="age" class="placeholder">age</label>
      </div>
      <div class="input-container ic2">
        <input
          id="profession"
          class="input"
          type="text"
          placeholder=" "
          v-model="profession"
        />
        <div class="cut"></div>
        <label for="profession" class="placeholder">profession</label>
      </div>
      <button class="submit">submit</button>
    </form>
  </div>
  <Popup v-if="toggleBoard" :response="response" />
</template>

<script>
import Popup from '../components/clients/Popup.vue'

export default {
  name : "Register",
  components : {
    Popup
  },
  props :["setCurrentState"],
  data() {
    return {
      nom : "",
      prenom : "",
      age : null,
      profession : "",
      response : {},
      toggleBoard: false
    }
  },
  methods : {
    register() {
      if(this.age != null && this.nom != "" && this.prenom != "" && this.profession != ""){
        fetch("http://localhost/Ahmed-Falah-RDVs/usersApi/AddUser",{
          method: 'POST',
          body: JSON.stringify({
              nom : this.nom,
              prenom : this.prenom,
              age : this.age,
              prefession : this.profession
          })
        })
        .then( response => response.json() )
        .then( json => {
          this.response.message = json.message;
          this.response.ref = json.reference;
          
        });
        this.toggleBoard = !this.toggle;
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  .RegisterContainer{
    background-color: $secondary-color;
    padding: 55px;
    font-family: $poppins;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20%;
    h1{
      color: white;  
    }
    form {
      box-sizing: border-box;
      padding: 15px;
      width: 320px;
      .subtitle {
        color: #eee;
        font-family: $tenor;
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 10px;
      }
      .input-container {
        height: 40px;
        position: relative;
        width: 100%;
        font-family: inherit;
        .input {
          background-color: #303245;
          border-radius: 12px;
          border: 0;
          box-sizing: border-box;
          color: #eee;
          font-size: 18px;
          height: 100%;
          outline: 0;
          padding: 4px 20px 0;
          width: 100%;
          font-family: inherit;
        }
        .cut {
          background-color: inherit;
          border-radius: 10px;
          height: 20px;
          left: 20px;
          position: absolute;
          top: -20px;
          transform: translateY(0);
          transition: transform 200ms;
          width: 90px;
        }
  
        .cut-short {
          width: 50px;
        }
      }
  
      .ic1 {
        margin-top: 40px;
      }
  
      .ic2 {
        margin-top: 30px;
      }
      .placeholder {
        color: #65657b;
        font-family: inherit;
        left: 20px;
        line-height: 10px;
        pointer-events: none;
        position: absolute;
        transform-origin: 0 50%;
        transition: transform 200ms, color 200ms;
        top: 16px;
      }
      .submit {
        background-color: #08d;
        border-radius: 8px;
        border: 0;
        box-sizing: border-box;
        color: #eee;
        cursor: pointer;
        font-size: 1rem;
        height: 30px;
        margin-top: 15px;
        text-align: center;
        width: 100%;
        font-family: inherit;
      }
  
      .submit:active {
        background-color: $primary-color;
      }
    }
  
    .input:focus ~ .cut,
    .input:not(:placeholder-shown) ~ .cut {
      transform: translateY(8px);
    }
  
    .input:focus ~ .placeholder,
    .input:not(:placeholder-shown) ~ .placeholder {
      transform: translateY(-30px) translateX(10px) scale(0.75);
    }
  
    .input:not(:placeholder-shown) ~ .placeholder {
      color: white;
    }
  
    .input:focus ~ .placeholder {
      color: white;
    }

  }
  @media screen and (max-width : 800px) {
    .RegisterContainer{
      flex-direction: column;
    }
  }
</style>