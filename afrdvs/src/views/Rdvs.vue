<template>
  <div>
  <div class="bigContainer">
  <h3 ref="rdvs"></h3>   
  <div class="container">
    <div class="agendaNav">
      <button @click="decrementTheOneDay()">&#60;&#60;</button>
      <h4 ref="month"></h4>
      <button @click="incrementTheOneDay()">&#62;&#62;</button>
    </div>
    <div id="weekdays" >
      <div>Su</div>
      <div>Mo</div>
      <div>Tu</div>
      <div>We</div>
      <div>Th</div>
      <div>Fr</div>
      <div>Sa</div>
    </div>
    
    <div ref="calendar" id="calendar">
      
    </div>
    
  </div>  
    <div>
    <Child :name ="rdvs" :plus="plus" :count = "count" :setCount = "setCount" :todayDate = "todayDate"
     :editCondition = "editCondition" :sujetToUpdate = "sujetToUpdate"/>
  </div>
  </div>
  </div>
  
</template>

<script>
import { h } from 'vue';
import Child from './Child.vue';
export default {
  name : "rdvs",
  props : {
     editCondition : Boolean,
     sujetToUpdate : String
  },
  data(){
    return {
       oneMonth : 0,
       rdvs : [],
       plus : false,
       count : 0,
       todayDate : undefined,
       pageContent : true,
    }
  },
  components : {
    Child
},
  methods : {
     setCount(n){
      this.count = n
     },
     displayCalenderDays(){
       console.log("I'm in");
  const date = new Date();
  //Date class => By default gives cuurent date but you could change that if you define a date in the constructor
  const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
  //Current Date infos => S
  console.log(date);
  const day =  date.getDate();
  const month = date.getMonth();
  const year = date.getFullYear();
  //The date of every month
  const firstDayOfTheMonth = new Date(year,month + this.oneMonth,1);
  const daysInCurrentMonth = new Date(year,(month + this.oneMonth)+1,0).getDate();
  const dateString = firstDayOfTheMonth.toLocaleDateString('en-us',{
     weekday : 'long',
     year : 'numeric',
     month : 'long',
     day : 'numeric',
  })
  const dateStringArray = dateString.split(', ');  
  this.$refs.calendar.innerText = "";
  this.$refs.month.innerText = dateStringArray[1].split(' ')[0] + " "+ dateStringArray[2];
  let daySquares = [];
  const pastDays = weekdays.indexOf(dateString.split(', ')[0]);
  for(let i = 1;i<=pastDays + daysInCurrentMonth;i++){
    const daySquare = document.createElement('div');
    if(i > pastDays){
      daySquare.innerText = i - pastDays;
      daySquare.classList.add("day");
      if((i - pastDays)==day && firstDayOfTheMonth.getMonth() == month && firstDayOfTheMonth.getFullYear() == year){
           daySquare.style.color = "#247BA0";
           daySquare.style.backgroundColor = "#DDD";  
           daySquare.classList.add("emptyDay");
      }else if((i - pastDays) < day && firstDayOfTheMonth.getMonth() == month && firstDayOfTheMonth.getFullYear() == year){
       daySquare.style.backgroundColor = "#DDD";   
       daySquare.classList.add("pastDays"); 
      }else if(firstDayOfTheMonth.getMonth() < month && firstDayOfTheMonth.getFullYear() <= year || firstDayOfTheMonth.getFullYear() < year ){
       daySquare.style.backgroundColor = "#DDD"; 
       daySquare.classList.add("pastDays"); 
      }
    
    }else if(i<=pastDays){
       daySquare.classList.add("emptyDay");
    }
    daySquare.setAttribute('data-date',firstDayOfTheMonth.getFullYear()+"-"+(firstDayOfTheMonth.getMonth()+1)+"-"+(i-pastDays));
    daySquare.addEventListener('click', ()=> {
     let url = "http://localhost/Ahmed-Falah-RDVs/rdvsapi/getRdvByDate/";
     const response = fetch(url + daySquare.getAttribute('data-date'));
     response.then(res => res.json()).then(data => data.forEach(element => {
       this.rdvs.push(element);
       console.log(element);
     })
     ).then( () => {
      if(this.rdvs.length > 0){
       console.log("count is 2");
       this.count = 2
       this.todayDate = daySquare.getAttribute('data-date');

    }else{
      console.log("count is 1");
      this.count = 1
      this.todayDate = daySquare.getAttribute('data-date');
    }
    } 
     );
    this.plus = true 
  });
    daySquares.push(daySquare);   
    this.$refs.calendar.append(...daySquares);
  }
  },
  incrementTheOneDay(){
    console.log(this.oneMonth);
    this.oneMonth = this.oneMonth + 1;
    this.displayCalenderDays();
  },
  decrementTheOneDay(){
    console.log(this.oneMonth);
    this.oneMonth = this.oneMonth - 1;
    this.displayCalenderDays();
  },
  redirect() {
    let bool = window.localStorage.getItem("ref");
    if (bool === null) {
      this.$router.push({ name: "login" });
    } else if (bool !== "admin") {
      this.$router.push({ name: "rdvs" });
    }else if (bool === "admin") {
      this.$router.push({ name: "dashboard" });
    }
  },
    //  bringRdvs(date){
    //    let url = "http://localhost/Ahmed-Falah-RDVs/rdvsapi/getRdvByDate/";
    //    const response = fetch(url + date);
    //    response.then(res => res.json()).then(rdvs => console.log(rdvs));
    // },
    debugging(data) {
      console.log(data);
    },
   changePageContent(){
     if(this.pageContent == true){
       this.pageContent = false;
     }else {
       this.pageContent = true;
       this.displayCalenderDays();
     }
   }

  },
  mounted() {
    this.displayCalenderDays();
    this.redirect();
  },
};
</script>

<style lang="scss">
.bigContainer{
  display: flex;
  flex-direction: row;
}
.container{
  width: 434px;
  margin: 20px 10px 0px 30px;
  font-family: $poppins;
  font-weight: 200;
}
button {
  background-color: $primary-color;
  color: white;
  border: none;
  padding: 5px;
  border-radius: 3px;
}
.agendaNav {
  display: flex;
  gap: 10px;
  justify-content: center;
  align-items: center;
}
.agendaNav > h4 {
  font-family: $tenor !important;
  font-weight: 600 !important;
}
#weekdays {
  width: 100%;
  display: flex;
  color: $primary-color;
  margin-top: 20px;
  gap: 2px;
  font-weight: 500 !important;
  background-color: $secondary-color;
  border-radius: 5px;
  margin-bottom: 3px;
  color: white;
}
#weekdays div {
  width: 60px;
  text-align: center;
  border-radius: 5px;
}
#calendar {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  gap: 2px;
}
.day {
  width: 60px;
  height: 60px;
  cursor: pointer;
  text-align: center;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.3em;
  border: 0.5px solid $secondary-color;
}
.day:hover {
  background-color: $primary-color;
  color: white;
}
.emptyDay {
  width: 60px;
  height: 60px;
  text-align: center;
  border-radius: 5px;
  cursor: not-allowed !important;
}
.pastDays{
  cursor: not-allowed !important;
}
h4{
text-align: center;
}
.rdvsButton{
  margin-top: 10px;
  float: right;
  margin-right: 20px;
  padding: 8px 18px;
}
.rdvsButton:hover{
  cursor: pointer;
  background-color: $secondary-color;
}
</style>