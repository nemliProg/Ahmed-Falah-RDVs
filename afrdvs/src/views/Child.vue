<template>
   <div class="alwaysHere">  
      <div v-if="plus"> 
       <div v-if = "rdvs.length > 0">
        {{ update() }}  
       </div> 
       <div v-if = "rdvs.length == 0">
        {{ update2()}}
       </div>
      </div>
    </div>       
</template>

<script>
    export default {
        name : "Child",
        props : {
          name : Array,
          plus : Boolean
        },
        data(){
            return {
               rdvs : this.name
        }
        },
        methods : {
         update(){
           console.log("I'm in update");
            var array = this.rdvs;
           for(let i = 1 ; i<=5;i++){
           if(array.length > 0 && array[0].creneau_rdv == i ){
               const newDive = document.createElement('div');
               //Add client name
               const clientName = document.createElement('P');
               clientName.classList.add("clinetName")
               clientName.innerText = array[0].prenom + " " + array[0].nom
               newDive.appendChild(clientName);
               //Add sujet_rdv
               const sujet_rdv = document.createElement('p');
               sujet_rdv.innerText = array[0].sujet_rdv;
               sujet_rdv.classList.add("sujet_rdv")
               newDive.appendChild(sujet_rdv);
               newDive.classList.add("oneRdv")
               document.querySelector('.alwaysHere').appendChild(newDive);
               array.shift();
             }else {
               const newDiv = document.createElement('div');
               newDiv.innerText = "Empty Randez-vous";
                newDiv.classList.add("emptyRdv")
               document.querySelector('.alwaysHere').appendChild(newDiv);
             }
              
           }
           
           },
           update2(){
             console.log("I'm in update 2");
             for(let i = 1;i<=5;i++){
               const newDiv = document.createElement('div');
                newDiv.innerText = "Empty Randez-vous";
                newDiv.classList.add("emptyRdv")
                document.querySelector('.alwaysHere').appendChild(newDiv);
             }
           }
        }   
        }
        


    
</script>

<style lang="scss">
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
    cursor: pointer;
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
</style> 