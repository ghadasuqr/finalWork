
@extends('backend.layouts.app')

@section('content')

<div class="item">
    <div class="container  mt-5 text-center">      
        <div class="row">  
            <div class="col-md-12">
                <!-- admin -->
                <div class="admin ">
                    <div class="formHeader ">
                        <h5 class="sectionTitle"> إضافة سلايدر</h5>
                    </div>
                     <div class="main-bg py-3">
                        <h5 class="title"> بيانات السلايدر</h5>
                   
                    </div> 

               
                      <!--form  -->
                    {!! Form::Open(['class'=>'form-group  box-shadow  text-right' , 'files'=>true]) !!}
                        <h5 class="sectionTitle">
                            @if ($errors->any())
                            <div class="border py-2">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li class="list-item my-2">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(Session::has('success'))
                                {{Session::get('success')}}
                            @elseif(Session::has('fileErro'))
                                 {{Session::get('fileErro')}}
                            @endif
                        </h5>

                        <div class="full ">
                        <div class="custom-input half"> 
                                    
                                    <div class="full "> 
                                            <input  class="form-control  " type="text" name="title1"  value="{{old('title1')}}" placeholder="العنوان الرئيسي  " />
                                    </div>
                                    <div class="full "> 
                                          <input  class="form-control  " type="text" name="title2" value="{{old('title1')}}"  placeholder="العنوان الفرعي " />
                                    </div>

                                    <div class="full"> 
                                            <textarea name="content"   placeholder="المحتوى " >{{old('title1')}}</textarea>                                           
                                    </div>
                                    <div class="full px-5">                                         
                                            <label class="radio-inline half"><input type="radio" name="active" value="نعم">  مفعل</label>
                                           <label class="radio-inline half"><input type="radio" name="active" value="لا"> غير مفعل</label>
                                  
                                    </div>

                        </div>
                        <!-- half2 -->
                            <div class="custom-input half">

                                    <input  class="form-control " type="text" name="sort"  value="{{old('sort')}}"  placeholder="الترتيب  " />

                                 <div class="full border  "   style="padding-right:0" >
                                    <div class="dropdown  full"   style="padding-right:0">
                                            <button  class="btn main-bg  dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">اختر  منتج  
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">                                         
                                                     @foreach(App\Item::where('slider' , "نعم")->get() as $key =>$item)
                                                    <li>
                                                        <div class="full border py-2  "  style="padding-right:0">                                                                          
                                                             <label class="font-color"><input type="radio" name="itemCode" value="{{$item->code}}">{{$item->itemDescription}}</label>
                                                       <a  href="#" class="sliderImage">
                                                             <img   src=" {{ url( App\Itemimage::getImagesForItem($item->code) [0]) }}"  width="60 " height="60" alt="" > 
                                                        </a>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                            </ul>
                                        </div>
                                        <!-- full px 5 -->
                                    </div>
                                    <!-- dropdown -->
                            </div>
                            <!-- full border -->

                        </div>
                        <!-- half1 -->
                       
                        <!-- md-6 -->

                       
                           
            </div>
            <!-- full -->

                 <div class="text-center">          
                     <input   class=" btn get  mb-2 px-3" type="submit" name="addItem" value=" إضافة " />
                 </div>              
             
                {!! Form::Close() !!}
                  <!-- form -->
                </div>
                    <!-- admin  -->
       
                </div>
<!-- col-md-12 -->
         </div> <!--row-->
    </div><!--container-->
</div><!--item-->

@endsection
@section('showImageForItem')
<script>

// function readURL(input) {

// if (input.files && input.files[0]) {
//   var reader = new FileReader();

//   reader.onload = function(e) {
//     $('#self_image').attr('src', e.target.result);
//   }


//   reader.readAsDataURL(input.files[0]);
// }
// }

// $("#sliderImage").change(function() {
// readURL(this);
// });
// --------------------------------------------------------------------ajax 
$(document).ready(function(){
    $('#sliderImage').change(function(){
    var Code=$(this).val();
    // console.log(Code);
    getVal(Code);
    });//change

});//ready
function getVal(Code){

 var Url = "{{ url('dashboard/getSelected/itemCode') }}";
    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        url : Url,
        type : "POST",
        data: {Code:Code},
        dataType: 'json',
        success : function(data) {
            console.log( valueOf(data));
//  var dd=data.data;
//  console.log(dd);
// console.log ( "http://localhost/laMisk/public"+data   ) ;

//           $('#photo').attr('src' ,"http://localhost/laMisk/public"+data) ;
    }
        });//ajax

};//getVal fn    
     
</script>


@endsection
