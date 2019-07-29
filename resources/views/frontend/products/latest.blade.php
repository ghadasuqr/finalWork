<div class="MostSold -my-5">
    <div class="container">    
        <h5 class=" sectionTitle "> وصل حديثا  </h5>
        <div class="row">
        <?php $items=App\Item::latest();?>
        
        <!--  span to save id if found , to ckeck if the user logeed in to show class for addtowishlist -->

        <!--  span to save id if found , to ckeck if the user logeed in to show class for addtowishlist -->
     
            @foreach($items as $item)
            <div class="col-xs-12 col-sm-6 col-md-3">
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
                                        data-id= "{{$item->code}}" model-id="{{$item->modelNo}}" 
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
                            <h3 class="title"><a href="{{url('products/details/'.$item->code)}}"> {{$item->itemDescription}} </a></h3>
                            <div class="price">
                            @if(App\Sale::isCurrent($item->code))
                               
                                    <span class="newPrice">  {{  $item->price - ($item->price * $discount) / 100   }}  </span><span >ج</span> 
                                @endif  
                                    <span  class="{{ (App\Sale::isCurrent($item->code) ? 'oldPrice' : 'newPrice') }}" >
                                        {{$item->price}} ج  </span>
                                </div>
                                <a href="{{url('products/details/'.$item->code)}}"><button  class="buy">تفاصيل</button></a>
                        </div>
                </div>
            </div>
        <!-- col-sm-6 -->
            @endforeach
    </div><!--row-->
    </div> <!--container-->
</div> 










