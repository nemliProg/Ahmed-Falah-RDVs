<template>
  <div class="popup">
    <div class="layer"></div>
    <div class="popup-body">
      <h2>Copy Your reference and save it</h2>
      <p>{{response.message}}</p>
      <span @click="copy" ><span id="copy">{{response.ref}}</span><img src="../../assets/copy.png" alt="copy icon"></span>
       <router-link to="/login"><button>Go to login Page</button></router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "Update",
  props: [
    "response"
  ],
  data() {
    return {
      
    };
  },
  methods: {
    copy() {
      var copyText = document.getElementById("copy").innerText;
      navigator.clipboard
        .writeText(copyText)
        .then(() => {
          alert("Text copied to clipboard");
        })
        .catch((err) => {
          console.error("Error in copying text: ", err);
        });
    }
    }
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
  .popup-body {
    background: $primary-color;
    height: 200px;
    padding: 0px 40px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    border-radius: 20px;
    h2{
      color: white;
      font-family: $tenor;
    }
    p{
      color: white;
      font-size: 1.4rem;
    }
    span{
      background-color: white;
      color: $secondary-color;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 1.4rem;
      padding: 10px;
      border-radius: 10px;
      margin-top: 10px;
      img{
        width: 40px;
      }
    }
    button{
      margin-top: 20px;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
    }
  }
}
</style>