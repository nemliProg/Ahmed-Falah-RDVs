<template>
    <form class = "form">
        <p class = "form-title">Enter a description About Your Appointement</p> 
         <textarea type ="text" v-model ="sujet" cols="40" rows="10" id="input"></textarea>  
        <button class="submit" type="Submit" @click.prevent ="addRdv()" >Submit</button>   
    </form>
</template>

<script>




    export default {
        props : {
            date2 : String,
            creaneau : Number,
            todayDate : String,
            editCondition : Boolean,
            sujetToUpdate : String
        },
        data(){
        return {
          id : window.localStorage.getItem("id"),
          sujet : null
        }
        },
        methods : {
           changeSujet(){
               let sg = window.localStorage.getItem("sujet");
               this.sujet = sg === null ? "" : sg; 
           },
           addRdv(){
               let url = "http://localhost/Ahmed-Falah-RDVs/rdvsapi/addRdv";
               let response = fetch(url , {
                 method : "Post",
                 body : JSON.stringify({
                    sujet_rdv : this.sujet,
                    date_rdv : this.todayDate,
                    creneau_rdv : this.creaneau,
                    idClient : this.id,
                    idAdmin : 1
                 }) 
               })
               console.log("object");
               window.localStorage.removeItem("sujet");
               document.getElementById("input").value = "";
           }
        },
        mounted(){
          this.changeSujet();  
        }
    }
</script>

<style lang="scss">
.form{
  margin-top: 6px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items : center;
  width:300px;
  gap:15px;
  margin-left : 20px;
}
.submit{
    padding : 8px 135px;
    cursor: pointer;
}
.submit:hover{
    background-color : $secondary-color;
}
.form-title{
    font-family : $poppins;
    font-weight : 400;
    font-size : 1.2em;

}
</style>