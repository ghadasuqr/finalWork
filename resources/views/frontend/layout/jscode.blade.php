
<script>

$( document ).ready(function() {

    $('.product-grid .social li a.AddToWishlist').click(function(){
        // event.preventDefault();
       
        var  code= $(this).attr('data-id');
        var id=$('#userId').val();   

        var modelNo=$(this).attr('model-id');
        var oldCount=parseInt($  ('#favoriteCount').text()  );

        $('#wish_'+code).removeClass('fa-heart').addClass('fa-spinner fa-spin');

$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
var URL="{{url('ajax/addToWishlist')}}";
    $.ajax({
        url: URL ,
        method:'POST' ,
        data:{code:code , modelNo:modelNo} ,
        datatype:'json',
        success:function(data){
            if(data.success){
                $('#wish_'+code).removeClass('fa-spinner fa-spin').addClass('fa-check');
                $('#favoriteCount').text(oldCount+1);
            }else{
                $('#wish_'+code).removeClass('fa-spinner fa-spin').addClass('fa fa-thumbs-o-down');
            }
        }//success
    });//ajax
   
// ==================
// }//endif
                   
//============================
            // end check if user login  
    });//click
});//ready

</script>
<!-- =================================================== ProductDetails========================================= -->
<script>

$( document ).ready(function() {

    $('.product-info-item .action li a.AddToWishlist').click(function(){
        // event.preventDefault();
        var  code= $(this).attr('data-id');
        var modelNo=$(this).attr('model-id');
        var oldCount=parseInt($  ('#favoriteCount').text()  );

    $('#wish_'+code).removeClass('fa-heart').addClass('fa-spinner fa-spin');

$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
var URL="{{url('ajax/addToWishlist')}}";
    $.ajax({
        url: URL ,
        method:'POST' ,
        data:{code:code , modelNo:modelNo} ,
        datatype:'json',
        success:function(data){
            if(data.success){
                $('#wish_'+code).removeClass('fa-spinner fa-spin').addClass('fa-check');
                $('#favoriteCount').text(oldCount+1);
            }else{
                $('#wish_'+code).removeClass('fa-spinner fa-spin').addClass('fa fa-thumbs-o-down');
            }
        }//success
    });//ajax
   
// ==================
// }//endif
                   
//============================
            // end check if user login  
    });//click
});//ready

</script>

