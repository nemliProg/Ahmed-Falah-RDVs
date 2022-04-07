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
            <button>
              <img
                @click="showForm(client.id,$event)"
                src="../assets/edit.png"
                alt="Edit"
              />
            </button>
            <button>
              <img
                @click="deleteClient(client.id, $event)"
                src="../assets/remove.png"
                alt="Remove"
              />
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-if="toggle">
      <Update
        :showForm="showForm"
        :lnom="lnom"
        :lprenom="lprenom"
        :lage="lage"
        :lprofession="lprofession"
        :idClient="idClient"
      />
    </div>
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
      idClient: null,
      lnom: "",
      lprenom: "",
      lage: "",
      lprofession: "",
      toggle: false,
    };
  },
  methods: {
    showForm(id,event) {
      let x = 0;
      if (!this.toggle) {
        this.idClient = id;
        let root = event.target.parentElement.parentElement.parentElement;
        this.lnom = root.firstChild.innerText;
        this.lprenom = root.firstChild.nextElementSibling.innerText;
        this.lage = parseInt(root.firstChild.nextElementSibling.nextElementSibling.innerText);
        this.lprofession =root.firstChild.nextElementSibling.nextElementSibling.nextElementSibling.innerText;
      }else{
        this.lnom = this.lnom;
        this.lprenom = this.lprenom;
        this.lage = this.lage;
        this.lprofession =this.lprofession;
      }

      this.toggle = !this.toggle;
    },
    deleteClient(id, event) {
      fetch(`http://localhost/Ahmed-Falah-RDVs/usersApi/delete`, {
        method: "POST",
        body: JSON.stringify({
          id: id,
        }),
      })
        .then((response) => response.json())
        .then((res) => console.log(res.message));
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
  h3{
    text-align: center;
    margin-top: 20px;
    color: $secondary-color;
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