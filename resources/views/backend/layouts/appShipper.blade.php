
  <!-- ============================================================================== -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" dir="rtl">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"  content="ie=edge">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <link rel="stylesheet" href=" {{ url('backend/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href=" {{ url('backend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href=" {{ url('backend/assets/css/final.css')}}" >
     <link rel="stylesheet" href=" {{ url('backend/assets/css/animation.css')}}">





    <title> التوصيل  </title>
    <style>

    
    </style>
</head>
<body>
    <!-- Start Header -->
    <!--  Start Top Header -->
    <div class="top-Header">
        <div class="container">
            <div class="row social-top ">

                <div class=" col-md-6 col-sm-12 ">
                    <nav class="nav admin justify-content-center">
                        <a  href="{{url('dashboard/shipper')}}"  data-toggle="tooltip"  title="  الرئيسية" class="nav-link"><i  class="fa fa-home fa-2x " > </i></a>
                        <a  href="{{url('dashboard/shipper/ReturnedShipping')}}"  data-toggle="tooltip"  title="  مرتجع " class="nav-link"><i  class="fa fa-star fa-2x " > </i></a>

                    </nav>
                </div>
                <!-- End col-md-6 -->
                <!-- start col-md-6 -->
                <div class="  col-md-6  col-sm-12  text-center">
                <nav class="nav admin justify-content-center">            

                        @if(Auth::check()&& ( Auth::User()->Role == 2)  )     
                        <a   href="#" class="nav-link"><i  class="fa fa-heart-o " >   أهلا {{ Auth::User()->name }} </i>   </a> 
                        <a   href="{{ url('logoutBack')}}" class="nav-link" data-toggle="tooltip"  title=" خروج " ><i  class="fa fa-fast-forward  fa-2x fa-rotate-180"  > </i></a>
                        @endif 
                    </nav>

                </div>
                <!--  End col-md-6 -->
            </div>
            <!-- row -->
            
        </div>
        <!-- container -->
    </div>
    <!--=================================== End Top Header ==================================================-->
 
    <!--  -->
@yield('content')
    <!--  -->
   
    <!-- =================================Start Footer --===================================================== -->
    <div class="footer" style="margin-top: 100px;">
        <div class="container">
            <div class="row ">
            
       
            
                
            </div>
            
        </div>
</div>
          <!-- End Footer -->
          <!-- Start Copyright -->
          <div class="copyright">
            <div class="container">
    
    
    
              <div class="row ">
                <div class="col-md-6  col-sm-12 copy-info  my-2 sm-text-center ">
                        <span> كل الحقوق   محفوظة  | مسك
                        <script>document.write(new Date().getFullYear());</script> 
                   &copy; </span>
                </div>
    
    
    
                <div class="col-md-6 col-sm-12  listIcons my-2  sm-text-center ">
                    <!--  -->
                <div class="nav justify-content-center">
                <ul>
                <li>
                  <a href="{{url(   App\Setting::getSetting('facebookURL')  )}}" ><i   class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a href="{{url(   App\Setting::getSetting('twitterURL')  )}}" ><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                  <a href="{{url(   App\Setting::getSetting('googlePlusURL')  )}}" ><i class="fa fa-google-plus"></i></a>
                </li>
                <li>
                  <a href="{{url(   App\Setting::getSetting('youTubeURL')  )}}" ><i  class="fa fa-youtube"></i></a>
                </li>
              </ul>
                </div>  
                <!--  -->
                </div>
    
    
    
              </div>
              <!-- row -->
    
    
    
            </div>
            <!-- container -->
          </div>
          <!-- End Copy Right -->
    
    
    <script type="text/javascript" src="{{url('backend/assets/js/jquery-3.3.1.min.js')}}"></script>   
    
         <script type="text/javascript" src="{{url('backend/assets/js/popper.min.js')}}"></script> 
       <script type="text/javascript" src="{{url('backend/assets/js/bootstrap.min.js')}}"></script>
       <script type="text/javascript" src="{{url('backend/assets/js/main.js')}}"></script>
<!-- ------------------------------------------------------------------------- -->
     @yield('showImagesJs')
     @yield('totalInvoiceJS');
<!----------------------------------------------------------------------------------------  -->
    </body>
    </html>
    <!-- #============================================================================= End Auth -->
