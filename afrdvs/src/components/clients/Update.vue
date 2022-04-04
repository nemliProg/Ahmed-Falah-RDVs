<template>
  <div class="popup">
    <div class="layer"></div>
    <form>
      <div class="subtitle">Update Client</div>
      <div class="input-container ic1">
        <input id="nom" class="input" type="text" placeholder=" " v-model="nom"/>
        <div class="cut cut-short"></div>
        <label for="nom" class="placeholder">nom</label>
      </div>
      <div class="input-container ic2">
        <input id="prenom" class="input" type="text" placeholder=" " v-model="prenom"/>
        <div class="cut"></div>
        <label for="prenom" class="placeholder">prenom</label>
      </div>
      <div class="input-container ic2">
        <input id="age" class="input" type="number" placeholder=" " v-model="age"/>
        <div class="cut cut-short"></div>
        <label for="age" class="placeholder">age</label>
      </div>
      <div class="input-container ic2">
        <input id="profession" class="input" type="text" placeholder=" " v-model="profession"/>
        <div class="cut "></div>
        <label for="profession" class="placeholder">profession</label>
      </div>
      <button type="text" class="submit">submit</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "Update",
  data() {
    return {
      nom: "",
      prenom: "",
      age:null,
      profession: "",
      id:null
    };
  },
};
</script>

<style lang="scss" scoped>
.popup {
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 99;
  .layer {
    background-color: black;
    width: 100vw;
    height: 100vh;
    position: absolute;
    z-index: -1;
    filter: opacity(0.6);
  }
  form {
    background-color: #15172b;
    border-radius: 20px;
    box-sizing: border-box;
    padding: 20px;
    width: 320px;
    font-family: $poppins;
    .subtitle {
      color: #eee;
      font-family: $tenor;
      font-size: 1.5rem;
      font-weight: 600;
      margin-top: 10px;
    }
    .input-container {
      height: 50px;
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
        background-color: #15172b;
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
      line-height: 14px;
      pointer-events: none;
      position: absolute;
      transform-origin: 0 50%;
      transition: transform 200ms, color 200ms;
      top: 20px;

    }
    .submit {
      background-color: #08d;
      border-radius: 12px;
      border: 0;
      box-sizing: border-box;
      color: #eee;
      cursor: pointer;
      font-size: 18px;
      height: 50px;
      margin-top: 38px;
      // outline: 0;
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
    color: #808097;
  }

  .input:focus ~ .placeholder {
    color: $secondary-color;
  }
}
</style>