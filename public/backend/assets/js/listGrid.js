
//=============== add class active on active buttonaND REMOVE IT FROM ANOTHER BUTTON 

$(document).ready(function() {
    
    $('.buttons button').click(function(){
    
     $(this).addClass('active').siblings('button').removeClass('active');
    });
    $('.Listview').hide();

// /==================================   SHOW AND HIDE DIVS ========================
    $('#list').click(function(event){

        event.preventDefault();
     
              $('.gridview').hide();

        $('.Listview').show();

    
    
    } );

    $('#grid').click(function(event){
        event.preventDefault();

        $('.Listview').hide();

        $('.gridview').show();


    
    
    } );
        
        
        
        
});//ready