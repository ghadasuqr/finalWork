$(document).ready(function(){
//##==================================  invoicee total  ===================================================

$('[data-toggle="tooltip"]').tooltip(); 

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
 
  $('.fixed-menu').toggleClass('is-visible');

   var fixedMneuWidth =$('.fixed-menu').innerWidth();
var heightNav=$('.top-Header').innerHeight(); 

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

// =======================================

   
  // 



// ============================##  End   fixed menu animate  side bar in admin page  works fine ## ========================


// =============================== Start Product Detail Gallery =============================

// =================================== ##  Products Detail Page ==========================
var src; // must be outside the function 

$('.thumbnals img').on({
  
   
    click: function() {

         // src=$('.thumbnals .selected').attr('src');    

       var newsrc=$(this).attr('src'); 

       $('#bigger').hide().attr('src',newsrc).fadeIn(200); 
            }  ,
             mouseenter: function() {
     
              $(this).addClass('selected');
               
            }  , 
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
// =========================================== next========================= not 
$('.productdetails .big-image i.fa-chevron-right').click(function(){
  // alert('r');

if( $('.thumbnals .selected').is(':last-child') ){
  $('.thumbnals img').eq(0).mouseenter();
}else{

$('.thumbnals .selected').next().mouseenter();

}  



});
//==================   previous   ============================ not
$('.productdetails .big-image i.fa-chevron-left').click(function(){
// alert('f');
 

if( $('.thumbnals .selected').is(':first-child') ){
$('.thumbnals img:last').mouseenter();
  
}else{
$('.thumbnals .selected').prev().mouseenter();


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


$('.product-info .commentspan').click(function(){

$('.product-info-item .comments').fadeIn(200);

});
  

// End Comments==================================

// ==================== Ratings ======================  ###


     
});  //ready



//==================== animate Logo in  Slider  at the the begining of loading ============================
setInterval(function(){ 
  // toggle the class every five second
  $('#logo').toggleClass('logohover');  
      setTimeout(function(){
        // toggle back after 1 second
        $('#logo').toggleClass('logohover');  
      },500)

},1500);
//  ###  =======================================================================================  ###
