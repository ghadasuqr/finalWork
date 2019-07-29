
@section('rating')
<script>

$( document ).ready(function() {


$('.productdetails  .rating input').on('change', function() {

  var point=$('input[name=star]:checked', '.rating').val();
//   var code=$('input[name=code]', '.rating').val(); // works
    console.log( point+'/'+ code+'/'+modelNo); 
    $("#span-message-rating").fadeIn(600);            
    $("#span-message-rating").text("لقد اعطيت للمنتج " + point +" من اصل خمسة نقاط");
    $("#span-message-rating").fadeOut(2000);
    });//change

    $('.productdetails #rating').click(function(event){
       event.preventDefault();


        var code= $('#itemCode').val();
        var modelNo= $('#itemModelNo').val();
        var point=$('input[name=star]:checked', '.rating').val();
        var isChecked = $('input[name=star]').is(':checked');
        // alert(code  + point);
           if ( !isChecked )
           {
            $("#span-message-rating").text("  لابد من اختيار عدد من النجوم ");
            }

            $('#rateFontAwsome').removeClass('fa-heart').addClass('fa-spinner fa-spin');

            $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

            $.ajax({
            url: "{{url('addtofeedback')}}" ,
            type:'POST' ,
            data:{point:point , code:code} ,
            dataType:'json',
            success:function(data){
                if(data.success){
                    $("#span-message-average").text(data.average);
                    $('#rateFontAwsome').removeClass('fa-spinner fa-spin').addClass('fa fa-star');
                }else{
                    $('#rateFontAwsome').removeClass('fa-spinner fa-spin').addClass('fa fa-thumbs-o-down');
                }
            }//success
        });//ajax


    });//click
});//ready

</script>

@endsection