<div class="" style="margin:50px 0">
        <div class="adBig" style="margin:0 ; " >
             <div class="glower1 px-5">
               <!-- <h1 class="left"><span> <i class="fa fa-gift fa-x"></i></span> </h1> -->
                    
               <span class="ad-text">عرض {{  App\Setting::getSetting('saleName') }}  </span>
               <span class="ad-text">ينتهى بعد </span>
               <!-- ايام -->
               @if(App\Sale::EndedAT() > 0) 
               <span class="ad-count"  id="countDown">   </span> 
               @endif
               @if(App\Sale::EndedAT() == 0) 
               <span class="ad-count" id="countDown">   </span> 
               @endif
               <!-- ايام -->
                    <span  class="ad-price">  خصم    {{ App\Sale::maxDiscount() }}%</span>
    
    
            <h1 class="center"><span>S</span><span>A</span><span>L</span><span>E</span></h1>                               
                            
             </div>
                            
        </div>
   
       <span style="display:none" id="endAt">  {{  App\Sale::EndedAT() }}  </span> 
       <span style="display:none" id="endDate">  {{ json_encode( App\Sale::maxEndDate() ) }}  </span> 

 </div>
 @section('countDown')
 <script>
 $(document).ready(function(){


var endAt=$('#endAt').text();
var endDate=$('#endDate').text();

var endAtInt=parseInt($('#endAt').text());
// var endDate=parseInt($('#endDate').text());
// console.log(endAtInt+"endedaaaaaaaaaaaaat");
console.log(endDate+"end date ");


var added=endAtInt*24*60*60*1000;
var EndDateJS = new Date().getTime(endDate);

console.log(EndDateJS+"before");

EndDateJS=EndDateJS+added;

// console.log(EndDateJS+"after ");
var x = setInterval(function() {
     
     var now = new Date().getTime();



var distance =EndDateJS  - now ;
// console.log(distance+"distance");
// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

// Display the result in the element with id="demo"
document.getElementById("countDown").innerHTML = days + '<span class="mx-2 ad-d-h-s"> يوم </span>  ' + hours + '<span class="mx-2 ad-d-h-s"> ساعة </span>  '
+ minutes + '<span class="mx-2 ad-d-h-s"> دقيقة </span>  ' + seconds + '<span class=" ad-d-h-s"> ثانية </span> ';

// If the count down is finished, write some text 
if (distance < 0) {
  clearInterval(x);
  document.getElementById("countDown").innerHTML = '<span class=" ad-d-h-s"> انتهى العرض </span> ';
}
}, 1000);

// console.log(endDate);


 });
 
 </script>
 @endsection
