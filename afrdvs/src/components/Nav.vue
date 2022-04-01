<template>
  <nav>
    <div class="logo-holder">
      <router-link to="/">AFRdvs</router-link>
    </div>
    <ul>
      <li><router-link to="/dashboard">Dashboard</router-link></li>
      <li><router-link to="/about">About</router-link></li>
      <li><router-link to="/login">Login</router-link></li>
      <li><router-link to="/login" @click="logout">Logout</router-link></li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Nav",
  methods : {
    logout(){
      localStorage.clear();
    }
  }
};
</script>

<style lang="scss">
  nav {
      display: flex;
      justify-content: space-between;
      padding: 5px 20%;
      font-weight: 400;
      background-color: $primary-color;
      font-family: $poppins;
      color: white;
      .logo-holder {
        width: 150px;
        a {
          font-size: 1.5rem;
          text-decoration: none;
          color: inherit;
        }
      }
      ul {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        list-style: none;
        li {
          a {
            text-decoration: none;
            color: inherit;
          }
        }
      }
    }
</style>