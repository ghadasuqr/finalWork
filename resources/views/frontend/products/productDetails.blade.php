
@extends('frontend.layout.app')
@section('content')

<!-- =============================================================================================== -->
<!-- <script type="text/javascript" src="{{url('backend/assets/js/jquery-3.3.1.min.js')}}"></script>    -->


<!-- =============================================================================================== -->

<!-- start Product Detalis -->
<section class="products  ">
    <div class="container box-shadow mb-5">
        <div class="shopping-cart-header main-bg my-5">                
                <h4 class="title">  يجب اختيار اللون والمقاس قبل الضغط على أيقونة  الشراء</h4>
                <i class="fa fa-bell fa-2x  " ></i>  

        </div>
        @if ($errors->any())
        <h5 class="infoTitle">
            <div class="box-shadow py-2">
                <ul class="list-unstyled">
                         @foreach ($errors->all() as $error)
                            <li class="list-item my-2">{{ $error }}</li> 
                        @endforeach
                  </ul>
            </div>
        </h5>
        @endif

        <div class="row productdetails ">  
                <!-- col-md-5 -->
            <div class=" Big-image-container  col-sm-5 col-md-5 "> 

     
                    
                    <!-- div to hold code of item -->
                      <!-- div to hold code of item -->
                      <?php $images=array();
                           $images=App\Itemimage::getImagesForItem($item->code);           

                           $jsonImages=json_encode($images);                               
                        ?>

                      <div class=" big-image  ">

                            <div>  
                                 <!-- <i class="fa fa-chevron-left "></i> -->

                            <img   id="bigger"  src="{{url($images[0])}}">
                            <!-- <i class="fa fa-chevron-right "></i>               -->
                        </div>
                    </div><!--Big image-->

                    <div class=" thumbnals">

                            @foreach($images as $image) 
                            <div  class="item-gallery">
                                <img src="{{url($image) }}" > 
                            </div>
                            @endforeach

                     </div> <!--thumbnails-->  
          
                <!--here was satrs  -->
                     <!-- stars -->
                    <!--  container-rating -->
                        <span style="display:none" id="code">{{  json_encode($item->code) }}</span>
                        <span style="display:none" id="modelNo">{{  json_encode($item->modelNo) }}</span>
                    
                    <div class="container-rating  " style="direction:rtl">
                      
                        
                    {!! Form::Open(['url' =>'addtofeedback'  , 'method'=>'post'])   !!}

                                <div class="rating  ">
                                    <input type="radio"   value="5" id="star1" name="star"><label for= "star1"></label>
                                    <input type="radio"   value="4" id="star2" name="star"><label for= "star2"></label>
                                    <input type="radio"   value="3" id="star3" name="star"><label for= "star3"></label>
                                    <input type="radio"   value="2"  id="star4" name="star"><label for= "star4"></label>
                                    <input type="radio"   value="1"  id="star5" name="star"><label  for= "star5"></label>                         
                                    <!--  -->
                                    
                                    <input type="hidden" id="code" value="{{ $item->code}}"> 

                                     <input type="hidden" value="{{$item->modelNo}}" name="modelNo">                                    
                                    <!--  -->
                                </div>
                                <!-- rating -->
                    </div>
                    <!--container-rating -->
                    <!--container-rating -->
                    <div class="container-rating">
                            <div class="container-messages text-center   "   style="direction:rtl">        
                                <p class="font-color  "  id="span-message-rating" >    </p>
                            </div>
                    </div>
                      <!--container-rating -->

                    <div class=" text-center   "   style="direction:rtl">
                        <p class="font-color  py-2 " id="span-message-average" > {{ App\Feedback::Average($item->code)  }}  </p>
                    </div> 
                    <div class="  mt-2  mb-5 text-center "  >
                    @if (Auth::check() && Auth::User()->Role == 0 )   
                        <button  class="  get py-2  px-2"  id="rating" style="margin-top:0" name="stars" >
                        <i class="fa fa-star" id="rateFontAwsome">  </i>  اعتمد التقييم</button>
                          @else
                        <a   href="{{url('login')}}" class=" btn  get py-2  px-2"   style="margin-top:0"  
                         data-toggle="tooltip" title="لابد من الدخول اولا " style="a:hover:text-decoration:none !important ">
                         <!-- <a href=" {{ url('login')}} " class="  btn  get py-2 px-3 " data-toggle="tooltip" title="لابد من الدخول اولا " style="a:hover:text-decoration:none !important ;"> -->

                        <i class="fa fa-star" >  </i>  اعتمد التقييم</a>
                        @endif
                    
                    </div>
                {!! Form::Close() !!}
                <!-- stars -->
                <!--here was satrs  -->
            </div>
                <!-- col-md-5 -->
                    <!-- col-md-7 -->
            <div class=" product-info  col-sm-7 col-md-7 py-5m mb-5 ">




                <!-- childern product-info -->
               
                    <div class="product-info-item"><h2 class="sectionTitle text-right">   {{$item->itemDescription}} </h2>   </div>
              
                    @if(App\Sale::isCurrent($item->code))
                            <?php $discount=App\Sale::isCurrent($item->code); ?>
                    <div class="product-info-item sale"> <i class="fa fa-gift ml-3"></i>  <span class="sale-word"> تخفيض </span><span>{{ $discount }}%</span> </div> 
                    @endif
            
                    <!-- ===================== -->
                
                    <div class="product-info-item ">
                            @if(App\Sale::isCurrent($item->code))
                               
                                    <span class="newPrice">  {{  $item->price - ($item->price * $discount) / 100   }}  </span><span >ج</span> 
                                @endif  
                        <span  class="{{ (App\Sale::isCurrent($item->code) ? 'oldPrice' : 'newPrice') }}  " >
                                        {{$item->price}} ج  </span>
                       </div>

             <!-- ==================== -->

                    <div class="product-info-item  ">
                        <div class="detHeader">
                            <i class="fa fa-chevron-down "></i>  <h5 class="infoTitle">    تفاصيل التصميم   </h5>
                        </div>
                        <div class=" toggle-div" >

                                <!-- start of item Details table info  -->

                          
                            <div class="info-content"> 
                                <div class="info"> {{ $item->materialType1}} </div>
                                <div  class="content">{{ $item->materialRatio1}} <span>%</span> </div>
                            </div>
                            <div class="info-content"> 
                                <div class="info">{{ $item->materialType2}} </div>
                                <div  class="content">{{ $item->materialRatio2}} <span>%</span> </div>
                            </div>
                            <div class="info-content"> 
                                <div class="info"> الغسل  </div>
                                <div  class="content">{{ $item->wash}}</div>
                            </div>
                            <div class="advice  border px-3 py-2"> 
                                <h5  class= "infoTitle border-b">نصيحة المصمم     </h5>                                  
                                <p> {{ $item->advice}}</p>                                    
                            </div>
                               
                            <!-- End of item Details table info  -->
                        </div><!-- toogle - div-->
                    </div><!-- product info item -->
                    <!-- select -->
                    <!-- form ============================================================================================-->
                    {!! Form::Open(['url' =>'addTocart'  , 'method'=>'post'])   !!}
                    <input type="hidden" id="code" name="code" value="<?php //echo $row['code'] ;?>">
                    <input type="hidden" id="modelNo" name="modelNo" value="<?php // echo $row['modelNo'] ;?>">
                    <div >
                        <h5 class="infoTitle mb-1  py-1 pr-2">اختر اللون والمقاس</h5> 
                            
                            <!--  -->
                       
                        <div class="selectContainer">
                            <div class="select-style border">
                                    
                                <select name="color" id="colors"  class="colors">
                                    <option value="" >اختر اللون</option>
                                    @foreach(App\Color::where('code' , $item->code)->get() as $key =>$row)
                                    <option value="{{$row->id}}" > {{$row->color}}</option>
                                    @endforeach
                                </select> 
                            </div>
                            
                            <div class="select-style  border text-center">
                                <select name="size" id="sizes" >
                                
                    
                                </select>
                            </div> 
                        </div>
               
                    <!-- select -->
                    
             
                    <!-- cart favorite -->
                    <div  class="product-info-item">
                        <ul  class="action ">                                   
               
                        @if (Auth::check() && Auth::User()->Role == 0 &&Auth::User()->blocked==0 )   

    
                                <li>
                                   <a href="#" alt="شراء">
                                   
                                        <button  class="addToCart   get btn  py-2  px-3" type="submit" data-toggle="tooltip" title="لابد من اختيار اللون والمقاس" data-id="{{$item->code}}" model-id="$item->modelNo" class="get pb-1 px-2" name="toCart" >
                                            شـراء
                                        <i class="fa fa-shopping-cart fa "></i>
                                        </button>                              
                                    </a>
                                </li>
                                @elseif (Auth::check() && Auth::User()->Role == 0 &&Auth::User()->blocked==1 )   

                                <li>
                                   <a href="{{url('login/blocked')}}" alt="شراء"
                                   
                                         class="   get btn  py-2  px-3" type="submit" data-toggle="tooltip" title="لابد من الدخول أولا " data-id="{{$item->code}}" model-id="$item->modelNo" class="get pb-1 px-2" name="toCart" >
                                            شراء
                                        <i class="fa fa-shopping-cart fa "></i>
                                                                    
                                    </a>
                                </li>
                              
                                @else
                                <li>
                                   <a href="{{url('login')}}" alt="شراء"
                                   
                                         class="   get btn  py-2  px-3" type="submit" data-toggle="tooltip" title="لابد من الدخول أولا " data-id="{{$item->code}}" model-id="$item->modelNo" class="get pb-1 px-2" name="toCart" >
                                            شراء
                                        <i class="fa fa-shopping-cart fa "></i>
                                                                    
                                    </a>
                                </li>
                                @endif

                                <input type="hidden" value="{{$item->price}}" name="price">
                                <input type="hidden" value="{{$item->code}}" name="code">
                                <input type="hidden" value="{{$item->modelNo}}" name="modelNo">
                                <input type="hidden" value="{{$item->itemDescription}}" name="itemDescription">
                {!! Form::Close() !!} 
                <!-- End add to cart -->
                                <!-- ===================================================================== -->
                                @if (Auth::check() && Auth::User()->Role == 0 )   

                                <li>
                                    <!-- a -->
                                    <a  href=" @if (!Auth::check() || !Auth::User()->Role == 0 )   {{ url('login')}} @endif"
                                         class="@if ( !App\Favorite:: inWishList($item->code)) AddToWishlist @endif  get btn px-3" 
 
                                        data-id="{{$item->code}}"  model-id="{{$item->modelNo}}" alt="مفضلة"
                                        data-toggle="tooltip" title="@if ( App\Favorite:: inWishList($item->code))  مضافة من قبل  @else   اضف للمفضلة  @endif" >
                                        <!-- <button class="get btn  px-3" type="button" > -->
                                        مفضلة 
                                        <i class="@if ( App\Favorite:: inWishList($item->code))  fa fa-check @else  fa fa-heart @endif"  id="wish_{{$item->code}}"></i>
                                         <!-- </button> -->
                                        </a>
                               
                                <!--  -->
                                </li>
                                @else
                                <li>
                                <a href=" {{ url('login')}} " class="  btn  get py-2 px-3 " data-toggle="tooltip" title="لابد من الدخول اولا " style="a:hover:text-decoration:none !important ;">
                                مفضلة   <i class=" fa fa-heart"></i> 
                              </a>
                                @endif
                                </li>
                              

                                <!-- ===================================================================== -->
                                <!-- show this button ONly  if user login  -->
                                @if (Auth::check() && Auth::User()->Role == 0 &&Auth::User()->blocked==0 )   
                                <li  class="mr-4">                                   
                                   <span class="btn get  px-3  commentspan ">
                                            تعليق
                                        <i class="fa fa-commenting-o fa "></i>
                                    </span>                                  
                                </li>
                                @endif
                                <!-- show this button ONly  if user login  -->

                            </ul>                        
                    </div>                    
            
<!-- end of item table info  -->
            <!-- cart favorite -->
@include('frontend.products.comments')
<!-- ========================================================================== include comment.blade=================================== -->
<!-- ========================================================================== include comment.blade=================================== -->
<!-- ========================================================================== include comment.blade=================================== -->
                <!--  END childern product-info -->
            </div> <!-- END product info-->
                <!-- col-md-7 -->               
        </div><!--row-->
        <!-- End Product Detalis -->

            
    </div><!--container-->
</section>

@endsection
<!-- ==========================================================  end section  content  php  =================================================== -->
<!-- ==========================================================  end section  content  php  =================================================== -->
@include('frontend.products.rating')


<!-- ==================================================================== end section rating javascript =============================================== -->
@section('selectColorSize')
<script>
    $(document).ready(function(){

    $('.colors').change(function(){
        // console.log('changed');
        var color = $(this).val();
        
        $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

                $.ajax({
                    url :"{{ url('selectSize') }}/"+color,
                    type : "GET",                  
                    dataType: 'json',
                    success:function(data){
                        var selectedData = data;
                            // to clear tags before added again
                            $("#sizes").html('');
                            $('#sizes').append('<option value="" disabled selected>اختر مقاس </option>');

                                $.each(selectedData, function(key, val){
                                    $.each(val, function(key1, val1){
                                        $("#sizes").append('<option value='+val1.size+'>'+val1.size+'</option>');
                                    });
                            }); 
                    },
                    error:function(){ 
                        alert("error!!!!" );
                     }
                });//ajax
                
            });//change
    });//ready


</script>

@endsection