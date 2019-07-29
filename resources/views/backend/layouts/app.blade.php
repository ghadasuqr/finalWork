
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

<!--  ======================================================================================-->


<!-- ========================================================================================= -->

    <title> الإدارة </title>
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
                        <a  href="#"  class="nav-link"><i  class="fa fa-th fa-2x" data-toggle="tooltip"  title="      قائمة جانبية     " > </i></a>    

                        <a  href="{{url('dashboard/')}}" class="nav-link"><i  class="fa fa-dashboard fa-2x " > </i></a>
                        <a  href="{{url('dashboard/items')}}"  class="nav-link" data-toggle="tooltip"  title="     المفعلة الملابس     "><i  class="fa fa-female fa-2x" > </i></a> 
                        <a   href="{{url('dashboard/orders')}}" class="nav-link"data-toggle="tooltip"  title="      الطلبات     " ><i  class="fa fa-server fa-2x" > </i></a> 
                        <a  href="{{url('dashboard/sales')}}"  class="nav-link" data-toggle="tooltip"  title="      التخفيضات     "><i  class="fa fa-gift fa-2x" > </i></a>    
                        <a  href="{{url('dashboard/mostSoldAdmSale')}}"  class="nav-link" data-toggle="tooltip"  title="      الاعلى مبيعا فى كل تخفيض     "><i  class="fa fa-trophy fa-2x" > </i></a>    
                        <a  href="{{url('dashboard/getUsers')}}"  class="nav-link" data-toggle="tooltip"  title="      المستخدمين     "><i  class="fa fa-user-o fa-2x" > </i></a>    
                        <a  href="{{url('dashboard/comments')}}"  class="nav-link"data-toggle="tooltip"  title="      التعليقات     " ><i  class="fa fa-comment-o fa-2x" > </i></a>    
                    </nav>
                </div>
                <!-- End col-md-6 -->
                <!-- start col-md-6 -->
                <div class="  col-md-6  col-sm-12  text-center">
                <nav class="nav admin justify-content-center">            

                        <a   href="{{url('dashboard/latest')}}" class="nav-link"data-toggle="tooltip"  title="      الاحدث     " ><i  class="fa fa-snowflake-o fa-2x" > </i></a> 
                        <a   href="{{url('dashboard/models')}}" class="nav-link"data-toggle="tooltip"  title="      الموديلات     " ><i  class="fa fa-star fa-2x" > </i></a> 
                        <a   href="{{url('category')}}" class="nav-link" data-toggle="tooltip"  title="      الاقسام     "><i  class="fa fa-tags fa-2x" > </i></a> 
                        <a   href="{{url('dashboard/slides')}}" class="nav-link"data-toggle="tooltip"  title="      سلايدر     " ><i  class="fa fa-picture-o fa-2x" > </i></a> 
                        <a   href="{{url('dashboard/fq')}}" class="nav-link"data-toggle="tooltip"  title="      الاسئلة الشائعة     "><i  class="fa fa-question fa-2x" > </i></a> 

                        @if(Auth::check() )
                        <a   href="#" class="nav-link"><i  class="fa fa-heart fa-2x " >   أهلا {{Auth::User()->name }}</i>   </a> 
                        <a   href="{{ url('logoutBack')}}" class="nav-link" data-toggle="tooltip"  title="      خروج     " ><i  class="fa fa-fast-forward  fa-2x fa-rotate-180"  > </i></a>
                             
                        
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
    @include('backend.layouts.sidebar')
    <!--  -->
    @include('backend.layouts.welcome')

@yield('content')

    <!--  -->
   
    <!-- =================================Start Footer --===================================================== -->
    

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
    <!---------------------------------------------------------------------------------------important-->

     @yield('showImagesJs')
     @yield('showImageForItem')
     @yield('totalInvoiceJS')
     @yield('checkBoxJs')
     <!-- --------------------------------------------------------------------------------------- important  -->
     
    </body>
    </html>
    <!-- ================================================================= -->
