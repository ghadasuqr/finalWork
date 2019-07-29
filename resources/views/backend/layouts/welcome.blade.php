<div class="container" >
        <div class="row">
                    
             <div class="col-md-12 col-sm-12">
                 <div class="shopping-cart-header main-bg text-center">
                 <i class="fa fa-dashboard fa-3x" style="color:#fff"></i>
                 @if(Auth::check() && ( Auth::User()->Role == 1)  )

                   <h3 >      أهلا {{Auth::user()->name  }} </h3>  
                   @endif                       
                </div>
                </div>
                <!-- col12 -->
        </div>
        <!-- row -->
</div>
<!-- container -->