<template>
  <div>
    
    <table>
      <thead>
        <tr>
          <th>date</th>
          <th>creaneau</th>
          <th>sujet_rdv</th>
          
        </tr>
      </thead>
      <tbody>
        <tr v-for="rdv in rdvs" :key="rdv.id" id="allRdvs">
           <td>{{rdv.date_rdv }}</td>
           <td>{{rdv.creneau_rdv }}</td>
           <td>{{rdv.sujet_rdv }}</td>
           <button @click="deleteRdv(rdv.id)">Delete</button>
           <button @click="updateRdv(rdv.id,rdv.sujet_rdv)">Edit</button>
        </tr>
      </tbody>
    </table>
   
  </div>
  <div v-if="editCondition">
   <Rdvs :editCondition = "editCondition" :sujetToUpdate = "sujetToUpdate"/>
  </div>
</template>

<script>
import Rdvs from "./Rdvs.vue";
    export default {
    data: function () {
        return {
            id: window.localStorage.getItem("id"),
            rdvs: undefined,
            editCondition: false,
            sujetToUpdate : undefined,
            arrayOfCrs : {
              
            }
               

            
        };
    },
    methods: {
        getRdvs() {
            let url = "http://localhost/Ahmed-Falah-RDVs/rdvsapi/RdvsByUser/";
            let response = fetch(url + this.id);
            response.then(res => res.json()).then(data => this.rdvs = data);
        },
        deleteRdv(id) {
            let url = "http://localhost/Ahmed-Falah-RDVs/rdvsapi/delete/";
            let response = fetch(url + id);
            response.then(res => res.json()).then(data => console.log(data)).then(this.getRdvs());
        },
        updateRdv(id,value){
            this.deleteRdv(id);
            this.editCondition = !this.editCondition; 
            localStorage.setItem("sujet",value);
        }
    },
    mounted() {
        this.getRdvs();
    },
    components: { Rdvs }
}
</script>

<style lang="scss" scoped>
div {

table {
margin: 50px auto 0px;
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
color: black;
}

tr:hover td:not(:last-child) {
background: $primary-color;
color: white;
background-color: $secondary-color;
}
}
}
button{
  padding: 7px 22px;
  margin-left: 5px;
}
  }
</style>