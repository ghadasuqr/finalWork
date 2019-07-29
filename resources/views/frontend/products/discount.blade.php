
@extends('frontend.layout.app')
@section('content')
 <!-- ==================================================================================  if there is  sale Active -->

@if(count ($data)  >0 )

<div class="MostSold -my-5">
    <div class="container">    
        <!-- <h5 class=" sectionTitle ">  discount  </h5> -->
    @foreach($data as $Key => $sale)
    <div class="border">  <h5 class=" sectionTitle  ">  تخفيضات {{ $sale->percentageValue}}   % </h5></div>

        <div class="row my-5"> 


            @foreach( json_decode ($sale->itemsINsale)  as $key => $item)    <!-- $item  Here is  ---,, the code of item  ,,    -->
            <div class="col-xs-12 col-sm-6 col-md-3 my-3 ">
            <div class="product-grid box-shadow ">
                        <div class="product-image">
                            <a href="{{url('products/details/'.$item)}}">
                            <?php $images=array();
                            $images=App\Itemimage::getImagesForItem($item);                                   
                            ?>
                                <img class="pic-1 " src="{{url($images[0])}}">                         
                                <img class="pic-2" src="{{url( $images[1])}}">
                            </a>
                            <ul class="social">
                                <li><a href="{{url('products/details/'.$item)}}" data-tip="تفاصيل"><i class="fa fa-search"></i></a></li>
                                <!--  -->
                                <li>
                                    <a  href=" @if (! Auth::check())  {{ url('login')}} @endif"
                                     class="@if ( !App\Favorite:: inWishList($item)) AddToWishlist @endif" 
                                     data-id= "{{$item}}" model-id="{{App\Item::getModelNo($item)}}" 
                                         data-tip="@if ( App\Favorite:: inWishList($item))  مضافة من قبل  @else   اضف للمفضلة  @endif ">
                                        <i class="@if ( App\Favorite:: inWishList($item))  fa fa-check @else  fa fa-heart @endif"  id="wish_{{$item}}"></i>
                                    </a>
                                </li>
                                <!--  -->
                                  <li><a href="{{url('products/details/'.$item)}}" data-tip="اضف لمشترياتك"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            @if(App\Sale::isCurrent($item))
                            <?php $discount=App\Sale::isCurrent($item); ?>
                            <span class="product-new-label">sale</span>
                            <span class="product-discount-label">{{ $discount }}</span>
                            @endif                                  

                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="{{url('products/details/'.$item)}}"> {{   App\Item::getItemName($item ) }} </a></h3>
                            <div class="price">
                            @if(App\Sale::isCurrent($item))
                            <?php $price=App\Cart::getItemPrice($item);?>
                                    <span class="newPrice">  {{  $price - ($price * $discount) / 100   }}  </span><span >ج</span> 
                                @endif  
                                    <span  class="{{ (App\Sale::isCurrent($item) ? 'oldPrice' : 'newPrice') }}" >
                                        {{$price}} ج  </span>
                                </div>
                                <a href="{{url('products/details/'.$item)}}"><button  class="buy">تفاصيل</button></a>
                        </div>
                </div>
            </div>
         <!-- col-sm-6 -->
            @endforeach

      </div><!--row-->

      @endforeach

    </div> <!--container-->
</div>   <!--MostSold-->
<!-- ==================================================================================  if No sale Active -->
<!-- ==================================================================================  if No sale Active -->
@else
<div class="border py-5">
<h5 class ="sectionTitle py-5">  لا توجد تخفيضات حاليا .</h5>
</div>

@endif
<!-- ================================================================================= If No sales active -->



@if(count ($data) >0)
    <!-- pagination -->
        <div style=" display:flex ; justify-content:center ;width:100%">
                <div class="col-md-4 text-center  " style=" display:flex ; justify-content:center;width:100%">
                    {!! $data->links() !!}
                </div>
        </div>
    <!-- pagination -->
    @endif
@endsection()









