Skip to content
 
Search or jump to…

Pull requests
Issues
Marketplace
Explore
 
@salsabeal 
1
0 2 Mahmoud-Italy/eCommerce
 Code  Issues 0  Pull requests 0  Projects 0  Wiki  Insights
eCommerce/resources/views/frontend/layouts/productArea.blade.php
@Mahmoud-Italy Mahmoud-Italy Add files via upload
2b31152 2 days ago
117 lines (95 sloc)  6.18 KB
    
    <section class="htc__product__area bg__white">
         <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="product-categories-all">
                        <div class="product-categories-title">
                            <h3>{{$cat->name}}</h3>
                        </div>
                        <div class="product-categories-menu">
                            @if(count($cat->childs))
                                <ul>
                                    @foreach($cat->childs as $child)
                                    <li><a href="#">{{$child->name}}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="product-style-tab">
                        <div class="product-tab-list">
                            <ul class="tab-style" role="tablist">
                            
                            @if(count($cat->childs))
                                @foreach($cat->childs as $key => $child)
                                  @if(App\Product::where('cat_id',$child->id)->count())
                                <li class="@if($key == 0) active @endif">
                                    <a href="#home{{$key}}-{{$cat->id}}" data-toggle="tab">
                                        <div class="tab-menu-text">
                                            <h4>{{$child->name}}</h4>
                                        </div>
                                    </a>
                                </li>
                                    @endif
                                @endforeach
                            @endif

                            </ul>
                        </div>

                        <div class="tab-content another-product-style jump">

                        @if(count($cat->childs))
                            @foreach($cat->childs as $key => $child)
                               @if(App\Product::where('cat_id',$child->id)->count())
                            <div class="tab-pane @if($key== 0) active @endif" id="home{{$key}}-{{$cat->id}}">
                                <div class="row">
                                    <div class="product-slider-active owl-carousel">
                                            
                                        @foreach(App\Product::where('active',1)->where('cat_id',$child->id)->get() as $pro)
                                            <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                                <div class="product">
                                                    <div class="product__inner">
                                                        <div class="pro__thumb">
                                                            <a href="#">
                                                                <img src="{{ url($pro->image) }}" alt="product images">
                                                            </a>
                                                        </div>
                                                        <div class="product__hover__info">
                                                            <ul class="product__action">
                                                                <li><a data-toggle="modal" data-target="#productModal{{$pro->id}}" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                                        <li>
                                                            <a title="Add TO Cart" data-id="{{$pro->id}}" class="AddToCart">
                                                                <span id="cartIcon_{{$pro->id}}" class="ti-shopping-cart"></span></a>
                                                        </li>
                                                        
                                                        <li>
                                                            <a title="Wishlist" data-id="{{$pro->id}}" 
                                                                @if(App\Wishlist::getWishlist($pro->id) == 'ti-heart') class="AddToWishlist" @endif
                                                                style="cursor: pointer">
                                                            <span id="wishIcon_{{$pro->id}}" 
                                                                class="{{App\Wishlist::getWishlist($pro->id)}}"></span></a>
                                                        </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product__details">
                                                        <h2><a href="product-details.html">{{$pro->name}}</a></h2>
                                                        <ul class="product__price">
                                                            @if($pro->price_discount > 0)
                                                            <li class="old__price">{{$pro->price_discount}}</li>
                                                            @endif
                                                            <li class="new__price">{{$pro->price}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                    </div>
                                </div>
                            </div>




                               @endif
                            @endforeach
                        @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





© 2019 GitHub, Inc.
Terms
Privacy
Security
Status
Help
Contact GitHub
Pricing
API
Training
Blog
About
public function addWishlist(Request $request)
   {
       try {
           $row = new Wishlist;
           $row->user_id = Auth::user()->id;
           $row->pro_id = $request->pro_id;
           $row->save();
           $status = true;
       } catch (\Exception $e) {
           $status = false;
       }
       return response()->json(['success'=>$status]);
   