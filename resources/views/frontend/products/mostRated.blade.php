
@extends('frontend.layout.app')
@section('content')

<div class="MostSold -my-5">
    <div class="container">    
        <h5 class=" sectionTitle "> الاعلى تقيما   </h5>
<!-- --------------------------------- if data found -->

@if(count($items) == 0)
<div class=" py-3 my-5">  <h5 class=" sectionTitle  border py-5 ">   عفوا لا توجد نتايج توافق ما بحثت عنه  </h5></div>
@else
<!-- --------------------------------- if data found -->

        <div class="row my-5">
   <!--  span to save id if found , to ckeck if the user logeed in to show class for addtowishlist -->
   <span id="userId" style="display:none"> @if(Auth::check()) {{ Auth::User()->id}} @endif</span>
        <!--  span to save id if found , to ckeck if the user logeed in to show class for addtowishlist -->

    @foreach($items as $item)
            <div class="col-xs-12 col-sm-6 col-md-3 my-3">
            <div class="product-grid box-shadow ">
                        <div class="product-image">
                            <a href="{{url('products/details/'.$item->code)}}">
                            <?php $images=array();
                            $images=App\Itemimage::getImagesForItem($item->code);                                   
                            ?>
                                <img class="pic-1 " src="{{url($images[0])}}">                         
                                <img class="pic-2" src="{{url( $images[1])}}">
                            </a>
                            <ul class="social">
                                <li><a href="{{url('products/details/'.$item->code)}}" data-tip="تفاصيل"><i class="fa fa-search"></i></a></li>
                                <!--  -->
                                <li>
                                <a  href=" @if (!Auth::check() || !Auth::User()->Role == 0 )   {{ url('login')}} @endif"
                                     class="@if ( !App\Favorite:: inWishList($item->code)) AddToWishlist @endif" 
                                        data-id= "{{$item->code}}" model-id="{{App\Item::getModelNo($item->code)}}" 
                                         data-tip="@if ( App\Favorite:: inWishList($item->code))  مضافة من قبل  @else   اضف للمفضلة  @endif ">
                                        <i class="@if ( App\Favorite:: inWishList($item->code))  fa fa-check @else  fa fa-heart @endif"  id="wish_{{$item->code}}"></i>
                                    </a>
                                </li>
                                <!--  -->
                                  <li><a href="{{url('products/details/'.$item->code)}}" data-tip="اضف لمشترياتك"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            @if(App\Sale::isCurrent($item->code))
                            <?php $discount=App\Sale::isCurrent($item->code); ?>
                            <span class="product-new-label">sale</span>
                            <span class="product-discount-label">{{ $discount }}</span>
                            @endif                                  

                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="{{url('products/details/'.$item->code)}}"> {{ App\Item::getItemName($item->code)}} </a></h3>
                            <h3 class="title"><a> <span>  ( {{ $item->average * 20 }} ) %</span></a></h3>

                            <div class="price">
                                <!-- $items here just contain code and modelNo , so we get price from Item by fn  -->
                            <?php $price=App\Item::getPrice($item->code);?>

                            @if(App\Sale::isCurrent($item->code))

                                    <span class="newPrice">  {{  $price - ($price * $discount) / 100   }}  </span><span >ج</span> 
                                @endif  
                                    <span  class="{{ (App\Sale::isCurrent($item->code) ? 'oldPrice' : 'newPrice') }}" >
                                        {{$price}} ج  </span>
                                </div>
                                <a href="{{url('products/details/'.$item->code)}}"><button  class="buy">تفاصيل</button></a>
                        </div>
                </div>
            </div>
         <!-- col-sm-6 -->
            @endforeach
      </div><!--row-->
<!-- --------------------------------- if data found -->
@endif
<!-- --------------------------------- if data found -->

    <!-- pagination -->
    @if(count ($items) >0)
            <div style=" display:flex ; justify-content:center ;width:100%">
                    <div class="col-md-4 text-center  " style=" display:flex ; justify-content:center;width:100%">
                        {!! $items->links() !!}
                    </div>
            </div>
    @endif
    <!-- pagination -->


    </div> <!--container-->
</div>   <!--MostSold-->
@endsection()









