<template>
  <h3 v-if = "el">
  {{ el[0].id }}
  </h3>
  <div class="container">
    <div class="agendaNav">
    <button @click="decrementTheOneDay()"> &#60;&#60; </button>
    <h4 ref="month"></h4>
    <button @click="incrementTheOneDay()"> &#62;&#62; </button>
    </div>
   
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



<script>
export default {
  name : "Dashboard",
  data(){
    return {
       oneMonth : 0,
       el : undefined
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
      }else if((i - pastDays) < day && firstDayOfTheMonth.getMonth() == month && firstDayOfTheMonth.getFullYear() == year){
       daySquare.style.backgroundColor = "#DDD";    
      }else if(firstDayOfTheMonth.getMonth() < month && firstDayOfTheMonth.getFullYear() <= year || firstDayOfTheMonth.getFullYear() < year ){
       daySquare.style.backgroundColor = "#DDD"; 
      }
      
    }else if(i<=pastDays){
       daySquare.classList.add("emptyDay");
    }
    daySquare.setAttribute('data-date',firstDayOfTheMonth.getFullYear()+"-"+(firstDayOfTheMonth.getMonth()+1)+"-"+(i-pastDays));
    daySquare.addEventListener('click', function(){
     let url = "http://localhost/Ahmed-Falah-RDVs/rdvsapi/getRdvByDate/";
     const response = fetch(url + daySquare.getAttribute('data-date'));
     response.then(res => res.json()).then(rdvs => console.log(rdvs));
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
  //  bringRdvs(date){
  //    let url = "http://localhost/Ahmed-Falah-RDVs/rdvsapi/getRdvByDate/";
  //    const response = fetch(url + date);
  //    response.then(res => res.json()).then(rdvs => console.log(rdvs));
  // },
  debugging(data){
    console.log(data);
  }

  },
  mounted(){
      this.displayCalenderDays();
  }
}
</script>

<style lang="scss">


</style>