
@extends('backend.layouts.app')

@section('content')


    <!-- =======================================================================  -->
<script type="text/javascript" src="{{url('backend/assets/js/jquery-3.3.1.min.js')}}"></script>   



<script>
$(function(){


$('.category').change(function(){
    console.log('changed');
    var val = $(this).val();
    getModel(val);
});
});
function getModel(val) {
    console.log('get Model()');
    var Url = "{{ url('dashboard/getSelected/data') }}";
    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        url : Url,
        type : "POST",
        data: {val:val},
        dataType: 'json',
        success : function(data) { 
            var selectedData = data;
            // to clear tags before added again
            $("#models").html('');
            $('#models').append('<option value="" disabled selected>اختر موديل </option>');

                $.each(selectedData, function(key, val){
                    $.each(val, function(key1, val1){
                        $("#models").append('<option value='+val1.modelNo+'>'+val1.modelName+'</option>');
                    });
            });
        }
    });
    return false;    
};

</script>
    <div class="item">
    <div class="container  mt-5 text-center">      
        <div class="row">  
            <div class="col-md-12">
                <!-- admin -->
                <div class="admin ">
                    <div class="formHeader ">
                        <h5 class="sectionTitle"> إضافة منتج</h5>
                    </div>
                     <div class="main-bg py-3">
                        <h5 class="title"> بيانات المنتج</h5>
                   
                    </div> 

               
                      <!--form  -->
                    {!! Form::Open(['class'=>'form-group  box-shadow  text-right' , 'files'=>true]) !!}
                        <!--  must be inside form for design -->
                        @if(Session::has('error'))
                            {{     Session::get('error')}}
 <!-- must  sum !>100  -->
                           
                            @elseif(Session::has('ratio'))
                            {{     Session::get('ratio')}}
<!-- must choose if value  edit dont let empty  -->
                            @elseif(Session::has('ratio2'))
                            {{     Session::get('ratio2')}}
<!-- must choose if image  edit dont let empty  -->

                            @elseif(Session::has('image'))
                            {{     Session::get('image')}}
   <!-- must choose if model  edit dont let empty  -->
                         
                            @elseif(Session::has('model'))
                            {{     Session::get('model')}}
<!-- must choose if category  edit dont let empty  -->
                         


                            @elseif(Session::has('materialRatio2'))
                            {{     Session::get('materialRatio2')}}
<!-- must choose if  count value   -->

                            @elseif(Session::has('imageCount'))
                            {{     Session::get('imageCount')}}
                            @endif
                        </h5>
                        <!--  -->
                        
                <h5 class="infoTitle my-3 text-center">
                @if ($errors->any())
                          <div class="border py-2">
                                <ul class="list-unstyled">
                                 @foreach ($errors->all() as $error)
                                      <li class="list-item my-2">{{ $error }}</li>
                                 @endforeach
                               </ul>
                         </div>
                       @endif
                 </h5>
                        <!--  -->

                        <div class="full ">
                            <div class="custom-input half">
                                    <div class="full-none-m"> 
                                       
                                        <select  class=" half category"  name="category" name="category"  id="category"   >
                                            <option value="" disabled selected>اختر فئة </option>                                        
                                                @foreach($cats as $cat)
                                                        <option value="{{$cat->categoryNo}}" }} >  {{ $cat->categoryName}} </option>
                                                  @endforeach    

                                        </select>

                                        <select   name="models" id="models"  class=" half">

                                       
                                        </select>                                    
                                    </div>
                             
                                    <input  class="form-control " type="text" name="itemDescription"   value="{{ old ('itemDescription')}}"  placeholder="الاسم " />

                                    <div class="full-none-m">                    
                                       
                                            <input  class="form-control half" type="number" name="quantity" value="{{ old ('quantity')}}"  min="1" max="1000" placeholder="الكمية " />
                                            <input  class="form-control half" type="number" name="price"   value="{{ old ('price')}}"  min="1" max="10000" step ="any" placeholder="السعر " />

                                    </div>
                               
                                 <div class="full border ">
                                        <input type="file" name="file_image[]" 
                                           id="file_image" title=""  multiple="multiple" MAX_FILE_SIZE="30000">
                                 </div>
                                   
                                    <!-- photo -->
                                        <div class="photo   border">
                                          
                                        
                                        </div>
                                    <!-- photo -->
                                  
                            </div>
                            <!-- half1 -->
                       
                        <!-- md-6 -->

                                <div class="custom-input half"> 
                                        <div class="full">              
                                            <input  class="form-control half" type="text" name="materialType1"  value="{{old ('materialType1')}}"  placeholder="نوع القماش "  />
                                         
                                            <input  class="form-control half" type="text" name="materialRatio1"   value="{{old ('materialRatio1')}}"  placeholder="نسبته " />
                                  
                                         </div>
                                        <div class="full">              
                                            <input  class="form-control half" type="text" name="materialType2"   value="{{old ('materialType2')}}" placeholder="نوع القماش "  />
                                     
                                            <input  class="form-control half" type="text" name="material2"  value="{{old ('material2')}}"   placeholder="نسبته " />
                                      
                                        </div>
                                        <div class="full "> 
                                             
                                                <input  class="form-control " type="text" name="wash"   value="{{old ('wash')}}" placeholder="طريقة الغسل" />
                                        </div>
                                
                                     
                                        <div class="full"> 
                                                <textarea name="advice"   class="form-control"  placeholder="نصيحة المصمم" >{{ old('advice')}} </textarea>                                           
                                                
                                        </div>
                                        <div class="full  ">                                         
                                            <label class="radio-inline half"><input type="radio" name="slider"  @if(Input::old('slider')) checked @endif  value="نعم">  سلايدر</label>
                                           <label class="radio-inline half"><input type="radio" name="slider"  @if(!Input::old('slider')) checked @endif   value="لا"> لا </label>
                                  
                                    </div>
                                        
                                     
                                          
                            </div>
                            <!-- half2 -->
                           
                        </div>
                        <!-- full -->
         <!-- =====================================colors===================================-->

                        <div class=" full-none-m border-top  pl-5 mx-4 my-4">
                                <ul class="nav  border-top2 pb-4 text-right">
                                        <?php   $colors=array("أبيض" ,"أسود" , "أحمر"  , "بيج"    ,"أزرق" , "بني" , "أخضر" , "رصاصي"); ?>
                                        @foreach($colors as $key => $color)
                                          <li class="nav-item   ">
                                            <label class="parent_check  ">
                                                    <input type="checkbox"  name="color{{$key}}" value=" {{$color}} " @if( old('color'.$key) == $color  ) checked @endif>
                                                    {{ $color}} <span class="checkmark" ></span>
                                            </label>
                                            <!--  --> 
                                            <ul class="nav  border  py-2  border-top-bottom flex-column text-right">
                                                            <?php   
                                                            
                                                            $sizes=array('xxL' , 'XL' , 'L' , 'M' ,'S');                
                                                            
                                                            ?>
                                                        @foreach($sizes as $val  => $size)
                                                        <li class="nav-item  ">
                                                            <label class="parent_checkz">
                                                                    <input type="checkbox"  name="size{{$key}}[]"  class= "size{{$key}}" value=" {{$size}} " 
                                                                     @if(is_array( old ('size'.$key) ) && in_array($size , old('size'.$key)) ) checked @endif>  
                                                                      {{ $size}} <span class="checkmarkz" ></span>
                                                            </label>                                                  
                                                        </li>
                                                        @endforeach
                                                                  <!--  -->
                                                                  <li class="nav-item  ">
                                                                  <label class="parent_checkz border-top2 bprder">
                                                                    <input type="checkbox"  id="all{{$key}}" value="  ">
                                                                   كل<span class="checkmarkz" ></span>
                                                            </label>
                                                            </li>
                                                            <!--  -->
                                                    </ul>                                              
                                            <!--  -->
                                            </li>
           
                                        @endforeach
                                    </ul>
                           </div>

    <!-- ============================================================================================= -->
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

    <!-- ============================   select script =============================  -->






<!-- ============================================================= -->
@endsection
@section('showImagesJs')
<script>
$(function() {
        // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

        };

        $('#file_image').on('change', function() {
        imagesPreview(this, 'div.admin .photo');

        
        });
});
     
     
</script>
@endsection
<!-- ------------------------------------------------------------------------------- -->
@section('checkBoxJs')


<script >
$(document).ready(function(){     
  
    var colors= ["أبيض" ,"أسود" , "أحمر"  , "بيج"    ,"أزرق" , "بني" , "أخضر" , "رصاصي" ];

       $.each(colors, function(key, color){

        $('#all'+key).click(function(){
                    if(this.checked) {
                        // Iterate each checkbox
                        $('.size'+key).each(function() {
                        this.checked = true;                        
                        });
                    } else {
                            $('.size'+key).each(function() {
                        this.checked = false;                       
                        });
                    }
        });//click             

    });//each color
 
}); //ready
</script>
@endsection