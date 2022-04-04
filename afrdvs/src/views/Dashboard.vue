<template>
  <div>
    <h1>Dashboard</h1>
    <table>
      <thead>
        <tr>
          <th>nom</th>
          <th>prenom</th>
          <th>age</th>
          <th>profession</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="client in clients" :key="client.id">
          <td>{{ client.nom }}</td>
          <td>{{ client.prenom }}</td>
          <td>{{ client.age }}</td>
          <td>{{ client.prefession }}</td>
          <td>
            <button  :data-id="client.id"><img src="../assets/edit.png" alt="Edit" /></button>
            <button ><img @click="deleteClient(client.id,$event)" src="../assets/remove.png" alt="Remove" /></button>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- <Update /> -->
  </div>
</template>



<script>
import Update from "../components/clients/Update.vue";

export default {
  name: "Dashboard",
  components: {
    Update,
  },
  data() {
    return {
      clients: null,
      nom: "",
      prenom: "",
      age: "",
      profesion: "",
    };
  },
  methods: {
    myFunc(event){
      console.log(event.target.parentElement.parentElement.parentElement.remove())
      console.log(event.target.parentElement.parentElement.parentElement)
    },
    deleteClient(id,event) {
      fetch(`http://localhost/Ahmed-Falah-RDVs/usersApi/delete/${id}`,{
        method: "DELETE",
      })
        .then((response) => response.json())
        .then((json) => {
          this.clients = json;
        });
        event.target.parentElement.parentElement.parentElement.remove();
    },
    allClients() {
      fetch("http://localhost/Ahmed-Falah-RDVs/usersApi/allUsers", {
        method: "GET",
      })
        .then((response) => response.json())
        .then((json) => {
          this.clients = json;
        });
    },
    redirect() {
      let bool = window.localStorage.getItem("ref");
      if (bool === null) {
        this.$router.push({ name: "login" });
      } else if (bool !== "admin") {
        this.$router.push({ name: "rdvs" });
      }
    },
  },
  mounted() {
    this.allClients();
    this.redirect();
  },
};
</script>

<style lang="scss" scoped>
  div {
    position: relative;
    h1 {
      text-align: center;
      margin-top: 20px;
      color: $primary-color;
    }
    table {
      margin: 15px auto 0px;
      thead {
        tr {
          background-color: $secondary-color;
          color: white;
          font-family: $tenor;
          font-weight: 100;
          border: 0.5px solid white;

          th {
            width: 100px;
            padding: 5px 30px;
            border-radius: 10px;
          }
        }
      }
      tbody {
        tr {
          td {
            text-align: center;
            padding: 5px;
            border-radius: 10px;
          }
          td:last-child {
            display: flex;
            gap: 10px;
            padding: 5px 20px;
            background-color: transparent !important;
            button {
              background-color: transparent;
              padding: 3px;
              border: none;
              display: flex;
              cursor: pointer;
              border-radius: 5px;
              width: 25px;
              img {
                width: 100%;
              }
            }
            button:first-child {
              background-color: rgb(131, 189, 247);
            }
            button:last-child {
              background-color: rgb(251, 101, 129);
            }
          }
        }
        tr:nth-child(even) td {
          background: rgb(112, 160, 226);
          color: white;
        }

        tr:hover td:not(:last-child) {
          background: $primary-color;
          color: white;
        }
      }
    }
  }
</style>