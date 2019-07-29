$(document).ready(function(){
// ============== toolTip

$('[data-toggle="tooltip"]').tooltip(); 



// Listen for click on toggle checkbox
$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});

//##================================== sale word style ===================================================

$('.product-grid .product-new-label').each(function() { 
    var value = $(this).text();
    if(value !== 'تخفيض') {     
       $(this).css('display', 'none'); 
    } else { 
      
       $(this).css('background-color', '#c90b0b');
    }
 });
 //## ===================  percentage  value style  ==========================================

 $('.product-grid span.product-discount-label').each(function() { 
   var value = $(this).text();
   if(value == '') {     
      $(this).css('display', 'none'); 
   } else { 
     
      $(this).css('background-color', '#333');
   }
});
// $('.product-grid span.product-discount-label ').css('background-color','#333');

// ============== invoice try ===============================================================
$('#printInvoice').click(function(){
   Popup($('.invoice')[0].outerHTML);
   function Popup(data) 
   {
       window.print();
       return true;
   }
});
// ==============  Start Carousel  ========================== -- did not work ====================


   'use strict';
  
   var winH    = $(window).height();
   var  upperH  = $('.top-Header').innerHeight();
    var  mediumHeader  = $('.medium-Header').innerHeight();
    var navH    = $('.navbar').innerHeight();
// $('.slider,  #slider-carousel').height(winH - ( upperH + navH + mediumHeader));
  

// ============== ===================== End Carousel  ============================================

//##==========================================  Start scroll to top ================= =================


var scrollToTop  = $('.scroll-to-top');
$(window).scroll(function(){

  if( $(window).scrollTop()>= 1000  ){

if(scrollToTop.is(':hidden') ){

      
          scrollToTop.fadeIn(400);

      }

}else{
scrollToTop.fadeOut(400);

}
});
// 

$('.scroll-to-top').click(function(event){


  event.preventDefault();
  $('html ,body').animate({
    scrollTop: 0

  } , 1000);
});

// 
//##==========================================  Start scroll to top ================= =================

// ============================= ##  To stop drop dwon list disappearing  when clickecd on it =======

$(document).on('click', '.dropdown-menu', function (e) {
  e.stopPropagation();
});

// ============================##  Start  fixed menu animate  side bar in admin page -- works fine ## ========================

// $('.navbar .navbar-nav  .nav-link i.fa-th').click(function(){
$('.social-top  .admin .nav-link i.fa-th').click(function(){
  $('.social-top .admin .nav-link i.fa-th').toggleClass('fa-window-close');

  $('.fixed-menu').toggleClass('is-visible');

   var fixedMneuWidth =$('.fixed-menu').innerWidth();
var heightNav=$('.top-Header').innerHeight(); 
// --------------------- calculate height of fixed menue------// did notwor-----

   var winH    = $('body').innerHeight();
   var  footerH  = $('.footer').innerHeight();	
    var copyrightH    = $('.copyright').innerHeight();
    var fixedHeight=winH-(footerH + copyrightH +heightNav);

    // ------------------------------------------------// did not work----
   if ($('.fixed-menu').hasClass('is-visible') ){
      $('.fixed-menu') .animate({
          right:0 ,
        marginTop:heightNav ,
        innerHeight:fixedHeight
          }
      ,500 );  
      // 
      
         }else{
           
         $('.fixed-menu') .animate({
            right:'-'+fixedMneuWidth ,
            marginTop:0
            }
                ,500 );


               }

});//fixed menu

// ============================##  End   fixed menu animate  side bar in admin page  works fine ## ========================


// =============================== Start Product Detail Gallery =============================

// =================================== ##  Products Detail Page ==========================
var scs;

$('.thumbnals img').on({
  
   
    click: function() {

   

      scs=$('.thumbnals .selected').attr('src');

     

       var nsrc=$(this).attr('src');        
       $('#bigger').hide().attr('src',nsrc).fadeIn(300); 
            } ,
             mouseenter: function() {
     
              $(this).addClass('selected');
               
            } ,  

            mouseleave: function() {
               $(this).toggleClass('selected');
               
            }   

           
});//chain
//  define an array of the images 
$('.productdetails .big-image').on({
  mouseenter: function() {
    $('.productdetails .big-image i').fadeIn(300);

  },
  mouseleave: function() {
    $('.productdetails .big-image i').fadeOut(300);

  }

});
/*============ arrows  to next and previous ========================

     !important 
      the array can be in the (document.ready ) but
       the (src) must be  inside the click  of arrows functions 
       because the source grapped just after the click not BEFORE
===================================================================*/
var arr=['images/show/show01.png' ,'images/show/show02.png' , 'images/show/show03.png', 'images/show/show04.png'];
// =============================== next =============================
$('.productdetails .big-image i.fa-chevron-right').click(function(){

  //  var arr=['images/img01.jpg' ,'images/img02.jpg' ];

    // source of the image from big one

    var src= $('#bigger').attr('src');       
   
    
// check if the img in the array

    function checkindex(img) {
    return img === src;
    }
    //obtain the indes of the value (src)

    var indexSelected =arr.findIndex(checkindex) ;
         var next=indexSelected+1;

    //make it go  next  

        if( indexSelected != (arr.length-1) ){        
            $('#bigger').hide().attr('src',arr[next]).fadeIn(300); 

        }else {
            $('#bigger').hide().attr('src',arr[0]).fadeIn(300);     
        } 

  
 });
 //==================   previous   ============================
 $('.productdetails .big-image i.fa-chevron-left').click(function(){

    var src= $('#bigger').attr('src');
        

         function checkindex(img) {
         return img === src;
         }
         var indexSelected =arr.findIndex(checkindex) ;

           var previous=indexSelected-1;
         if( indexSelected !== 0 ){
             $('#bigger').hide().attr('src',arr[previous]).fadeIn(300); 
 
         }else {
             $('#bigger').hide().attr('src',arr[arr.length-1]).fadeIn(300);     
         } 
             
   
  });
      // =============================== End Product Detail Gallery =============================
        // ================= toggle  product details of desginer===============

        
        $(" .product-info .product-info-item .detHeader").on("click", function() {
          $(this).find('i').toggleClass(' fa-chevron-down fa-chevron-up');
      // will (slide) toggle the related panel.
       $(this).toggleClass("active").next().slideToggle();
   });
        


  // ##====================== buy button  index and products pages ===
  $('.product-grid').mouseenter(function(){
    $(this).find('button').fadeIn(100);
  });

  $('.product-grid').mouseleave(function(){
    $(this).find('button').fadeOut(100);
  });
  

    

//======================  Start Accordion==============================================


        // Clicking on the accordion header title...
        $(".accordion .accordion-header").on("click", function() {
          $(this).find('i').toggleClass(' fa-chevron-down fa-chevron-up');
      // will (slide) toggle the related panel.
       $(this).toggleClass("active").next().slideToggle();
   });
        // 
//======================  End Accordion==============================================
// start comments=============================================


$('.product-info .fa-commenting-o').click(function(){

$('.product-info-item .comments').fadeIn(200);

});
  

// End Comments==================================
     
});  

//ready


// var header = $('#header');
// header.addClass('blue');
// setTimeout(function() {
//     header.removeClass('blue');
// }, 4000);

// var logo = $('#logo');
// logo.addClass('logohover');
// setTimeout(function() {
//   logo.removeClass('logohover');
// }, 4000);

//==================== animate Logo in  Slider  at the the begining of loading ============================
setInterval(function(){ 
  // toggle the class every five second
  $('#logo').toggleClass('logohover');  
      setTimeout(function(){
        // toggle back after 1 second
        $('#logo').toggleClass('logohover');  
      },500)

},1500);

