<template>
<button @click="incrementTheOneDay()">Click</button>
  <div class="container">
    <div id="weekdays">
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
  
</template>

<script>import { onMounted } from "vue";

export default {
  name : "Dashboard",
  data(){
    return {
       oneMonth : 0
    }
  },
  components : {

  },
  methods : {
     displayCalenderDays(){
  const date = new Date();
  //Date class => By default gives cuurent date but you could change that if you define a date in the constructor
  const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
  //Current Date infos => S
  const day =  date.getDate();
  const month = date.getMonth();
  const year = date.getFullYear();
  //The date of every month
  const firstDayOfTheMonth = new Date(year,month,1);
  const daysInCurrentMonth = new Date(year,month+1,0).getDate();
  const dateString = firstDayOfTheMonth.toLocaleDateString('en-us',{
     weekday : 'long',
     year : 'numeric',
     month : 'numeric',
     day : 'numeric',
  })
  const pastDays = weekdays.indexOf(dateString.split(', ')[0]);
  for(let i = 1;i<=pastDays + daysInCurrentMonth;i++){
    const daySquare = document.createElement('div');
    if(i > pastDays){
      daySquare.innerText = i - pastDays;
      daySquare.classList.add("day");
      if((i - pastDays)==day && firstDayOfTheMonth.getMonth() == month){
           daySquare.style.color = "#247BA0";
      }else if((i - pastDays) < day && firstDayOfTheMonth.getMonth() == month){
           daySquare.style.backgroundColor = "#DDD";
      }
    }
    else{
       daySquare.classList.add("emptyDay");
    }
    console.log(daySquare);
    this.$refs.calendar.appendChild(daySquare);
  }
  },
  incrementTheOneDay(){
    console.log(this.oneDay);
    this.oneDay = this.oneDay + 1;
    console.log(this.oneDay);
    
  }
  },
  mounted(){
      this.displayCalenderDays();
  }
  
}
</script>

<style lang="scss">
.container{
  width: 280px;
}
#weekdays {
  width: 100%;
  display: flex;
  color: #247BA0;
  
  margin-top: 20px;
}
#weekdays div {
  width: 40px;
 
  text-align: center;
}
#calendar{
  width: 100%;
  display: flex;
  flex-wrap: wrap;
}
.day{
  width: 40px;
  cursor: pointer;
  text-align: center;
  
}
.day:hover{
  background-color: #247BA0;
}
.emptyDay{
  width: 40px;
  cursor: pointer;
  text-align: center;

}

</style>