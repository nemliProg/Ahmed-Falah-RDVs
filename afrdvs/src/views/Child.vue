<template>
   <div class = "bigContainer">
     <div class="alwaysHere">  
      <div v-if="plus"> 
       <div v-if = "count == 2 ">
        {{ update() }}  
       </div> 
       <div v-else-if = "count == 1 ">
        {{ update2() }}
       </div>
      </div>
    </div>
    <div class="form" v-if="checking">
      <Form  :creaneau="creaneau" :todayDate = "todayDate" :editCondition="editCondition" :sujetToUpdate = "sujetToUpdate"/>
      
    </div>
   </div>
          
</template>

<script>
import Form from "./Form.vue";
    export default {
    name: "Child",
    props: {
        name: Array,
        plus: Boolean,
        count: Number,
        setCount: Function,
        todayDate : String,
        editCondition : Boolean,
        sujetToUpdate : String
    },
    data() {
        return {
            rdvs: this.name,
            checking: false,
            creaneau : undefined,
            client : undefined
        };
    },
    methods: {
        check() {
            this.checking = !this.checking;
        },
        update() {
            document.querySelector(".alwaysHere").innerHTML = " ";
            var array = this.rdvs;
            for (let i = 1; i <= 5; i++) {
                if (array.length > 0 && array[0].creneau_rdv == i) {
                    const newDive = document.createElement("div");
                    //Add client name
                    const clientName = document.createElement("P");
                    clientName.classList.add("clinetName");
                    clientName.innerText = array[0].prenom + " " + array[0].nom;
                    newDive.appendChild(clientName);
                    //Add sujet_rdv
                    const sujet_rdv = document.createElement("p");
                    sujet_rdv.innerText = array[0].sujet_rdv;
                    sujet_rdv.classList.add("sujet_rdv");
                    newDive.appendChild(sujet_rdv);
                    newDive.classList.add("oneRdv");
                    document.querySelector(".alwaysHere").appendChild(newDive);
                    array.shift();
                }
                else {
                    const newDiv = document.createElement("div");
                    newDiv.innerText = "Empty Randez-vous";
                    newDiv.classList.add("emptyRdv");
                    newDiv.addEventListener("click", () => {
                        this.creaneau = i;
                        this.check();
                    });
                    document.querySelector(".alwaysHere").appendChild(newDiv);
                }
            }
            this.setCount(0);
        },
        update2() {
            document.querySelector(".alwaysHere").innerHTML = "";
            console.log("I'm in update 2");
            for (let i = 1; i <= 5; i++) {
                const newDiv = document.createElement("div");
                newDiv.innerText = "Empty Randez-vous";
                newDiv.classList.add("emptyRdv");
                newDiv.addEventListener("click", () => {
                    this.creaneau = i;
                    this.check();
                });
                document.querySelector(".alwaysHere").appendChild(newDiv);
            }
        }
    },
    components: { Form }
}
        
        


    
</script>

<style lang="scss">
.bigContainer{
  display: flex;
  flex-direction: row;

}
.alwaysHere{
    width: 400px;
    margin-top: 60px;
    margin-left: 20px;
    font-family: $poppins;
    font-family: 300;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.oneRdv{
    padding-left:5px ;
    height: 60px;
    border: 1px solid #1282A6;
    cursor: not-allowed;
    border-radius: 5px;
}
.oneRdv:hover{
    background-color: $primary-color;
    color: white;
}
.clinetName{
    font-weight: 550;
}
.sujet_rdv{
    font-weight: 300;
    font-size: .9em;
}
.emptyRdv{
    padding-left:5px ;
    height: 60px;
    border: 1px solid #1282A6;
    cursor: pointer;
    border-radius: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 550;
}
.emptyRdv:hover{
    background-color: $primary-color;
    color: white;
}
.form{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items : center;
}
</style> 