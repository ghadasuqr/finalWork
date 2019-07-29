<?php $comments = \DB::table('feedbacks')->where('code' , $item->code)->where('comment', '!=' , '')->get() ;?>
            @if( count($comments) >  0)                  
                <div class="product-info-item mt-5 border px-3 text-left" >
                    <span style="font-weight:bold" id="count">  {{ count($comments)}}  </span> 
                    <span style="padding-right:20px;color:#e23853;">تعليق</span>
                </div>

                @foreach($comments as $key => $comment)
<!-- ===============================================  div for comment with feaadback ID  ======================== -->
                    <div id="{{'div-'.$comment->feedbackId}}"  class="product-info-item  border ">
                        
                    <!-- showComments  -->
                        <div class="showComments   px-3  ">                            
                            <span class="span-name" > {{ App\User::getNameById($comment->memberId)}} </span> 
                            <span class="span-date"> {{   date_format( date_create ($comment->created_at ) , "Y/m/d")  }} </span>
                        </div>
                        <!-- showComments -->

                        <!-- showComments -->
                        <div class="showComments px-3">
                            <div class="commentText ">
                                  {{ $comment->comment}}
                            </div>
                            @if(Auth::check())
                                @if(Auth::User()->id == $comment->memberId )                                                            
                                    <div class="text-left  divRemoveComment  ">
                                        <button   type="button"  id="{{$comment->feedbackId}}" class="btn  removetButton btn-danger"   data-id="{{$comment->feedbackId}}" > X</button>
                                    </div>
                                @endif
                                <!-- if for show remove button -->
                            @endif
                            <!-- if for check auth -->
                        </div>
                        <!--showComments-->
                    </div>
<!-- ================================================ div for comment with feaadback ID =========================================================== -->
                @endforeach
                <!-- to show comments from database -->              
            @endif 
               <!-- if count comments > 0 -->
                <div id="appendComment"></div>
                    <div  class="product-info-item ">
                        <div class="comments">
                            <h5 class="infoTitle">اضف تعليق </h5>
                            <textarea name="comments" id="content"  ></textarea><br>
                            <input type="hidden" id="comDate" value="<?php echo date('Y-m-d '); ?>">                            
                            <input type="hidden" id="itemCode" value="{{ $item->code}}"> 
                            @if(Auth::check())                           
                            <input type="hidden" id="memberName" value="{{ Auth::User()->name}}">                            
                            @endif
                            <button  type="button" id="sendCmnt" class="btn get commentButton px-4">  ارسل</button>
                            <p class="font-color infoTitle py-3 px-2" id="noCommentSent">  </p>
                        </div>
                        <!-- comments -->
                   
                    </div>
                    <!-- product-item -->
 @section('produtDetails')
<script>

$(document).ready(function(){
$('#sendCmnt').click(function(){
var comment= $('#content').val();
var CommentLength = comment.length;

alert(CommentLength);

var usernamecheck = /^[0-9ء,.a-zA-Zأ-ي\s]*$/u ;
    
    if(!$.trim(document.all.content.value).match(usernamecheck))
    {
        $('#noCommentSent').text(" يسمح فقط بالحروف والارقام والمسافات فى التعليق");
    
    }else if ( CommentLength > 60){
    $('#noCommentSent').text(" لا يسمح ان يزيد عدد حروف التعليق عن 60  حرف ");
  
   }else if(!comment){
$('#noCommentSent').text("   التعليق الفارغ غير مقبول  ");
} else{

var code= $('#itemCode').val();
var comDate= $('#comDate').val();
var memberName= $('#memberName').val();
var oldCount=parseInt($('#count').text());
$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
// alert(code+  '' +comment);
// ajax

var URL="{{url('ajax/addComment')}}";
        $.ajax({
            url: URL ,
            type:'POST' ,
            data:{code:code , comment:comment} ,
            dataType:'json',
            success:function(data){
                if(data.success){
                $("#appendComment").append('<div  class="product-info-item  border "><div class="showComments   px-3  "><span class="span-name" >'+memberName+'</span><span class="span-date">'+comDate+'</span></div><div class="showComments px-3"><div class="commentText ">'+comment+'</div></div>');
                $('#count').text(oldCount+1);
                $("#content").val('');                         
                }else{
                    $('#appendComment').text('يجب كتابة تعليق صالح');
                }
            }
        });//ajax
    }//else if 
    });//click
// =========================== add comment  ===========================

    $('.removetButton').click(function(){
    var feedbackId=$(this).attr('data-id');
    var oldCount=parseInt($('#count').text());
    // alert(feedbackId); //works
    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $.ajax({
                url: "{{url('ajax/removeComment')}}" ,
                type:'POST' ,
                data:{feedbackId:feedbackId} ,
                dataType:'json',
                success:function(data){
                    if(data.success){
                        $('#div-'+feedbackId).fadeOut(200);
                    $('#count').text(oldCount-1);
                    }else{
                        $('#appendComment').text('error');
                    }
                }
            });//ajax
    });//click


});//ready
// =================================== remove comment ==================================

</script>
@endsection()
