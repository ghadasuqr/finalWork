<!-- ====================================================================================== -->



<!-- ====================================================================================== -->
<section class="slider box-shadow "><!--slider-->

    <div class="container">

            <div class="row">

                <div class="col-sm-12  col-md-12">
                    <div id="slider-carousel" class="carousel slide"  data-interval="3000" data-ride="carousel">
                        <ol class="carousel-indicators">
<!-- ----------------------------------------------------------------- -->
                            @foreach(App\Slider::slidersToINdex() as $key=> $slider )
                                <li data-target="#slider-carousel" data-slide-to="{{$key}}"  class="{{$key==0 ? 'active' :''  }}" ></li>
                            @endforeach
<!-- ------------------------------------------------------------------------ -->
                        </ol>
<!-- ============================================================================================================= -->
                        <!-- inner -->

                        <div class="carousel-inner " >
                            <!--  -->
                            @foreach(App\Slider::slidersToINdex() as $key =>$slider )

                            <div class="carousel-item {{ $key ==0  ? 'active' : '' }}">

                                <div class="row">

                                        <div class="col-sm-12 col-md-6 slider-info ">

                                                <span class="misk"> {{ $slider->title1}}  </span>
                                                <h2 class="slider-title"> {{$slider->title2}} </h2>
                                                <p class="slider-text">{{$slider->content }}           </p>
                                                
                                                <a  href="{{url('products/details/'.$slider->itemCode)}}"  class="btn btn-default get">   احصل عليه الان </a>

                                            </div>
                                            
                                            <div class="col-sm-12 col-md-6 logoContainer">

                                                <img  src=" {{ url( App\Itemimage::getImagesForItem($slider->itemCode) [0]) }}" class="girl img-responsive" alt="" />
                                                <div  id="logo" class="logo">
                                                </div>

                                            </div>

                                </div>
                                <!-- row -->
                            </div>
                            
                            <!-- item -->
                            @endforeach

                        </div>
                        <!-- inner -->
                        
<!-- ===================================================================================================== -->
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    <!-- slider carosel -->
                    
                </div>
                <!-- col-sm-12 -->
            </div>
            <!-- row -->

    </div>
    <!-- container -->

</section><!--/slider-->
      <!--==================================== End Slider ==============================================-->

