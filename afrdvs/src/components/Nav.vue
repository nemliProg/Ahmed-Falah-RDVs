<template>
  <nav>
    <div class="logo-holder">
      <router-link to="/">AFRdvs</router-link>
    </div>
    <ul>
      <li v-if="currentState?.role === 'admin'"><router-link to="/dashboard">Dashboard</router-link></li>
      <li v-if="currentState?.role !== 'admin' && currentState?.role"><router-link to="/rdvs">rdvs</router-link></li>
      <li v-if="currentState?.role !== 'admin' && currentState?.role"><router-link to="/allRdvs">All Rdvs</router-link></li>
      <li><router-link to="/about">About</router-link></li>
      <li><router-link to="/">Home</router-link></li>
      <li v-if="!currentState?.role">
        <router-link to="/login">Login</router-link>
      </li>
      <li v-if="!currentState?.role">
        <router-link to="/register">Register</router-link>
      </li>
      <li v-if="currentState?.role">
        <router-link to="/login" @click="logout">Logout</router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Nav",
  props: ["setCurrentState", "currentState"],
  methods: {
    logout() {
      localStorage.clear();
      this.setCurrentState(undefined);
    },
    verifyLogin() {
      let ls = window.localStorage;
      if (ls.getItem("ref") === null) {
        
      } else if (ls.getItem("ref") === "admin") {
        this.setCurrentState({ role: "admin", id: ls.getItem("id") });
      } else {
        this.setCurrentState({ role: ls.getItem("ref"), id: ls.getItem("id") });
      }
    },
  },
  data() {
    return {};
  },
  mounted() {
    this.verifyLogin();
  },
};
</script>

<style lang="scss" scoped>
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