<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" dir="rtl">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- token -->
     <link rel="stylesheet" href="{{url('frontend/assets/css/font-awesome.min.css')}}">
     <link rel="stylesheet" href="{{url('frontend/assets/css/bootstrap.min.css')}}">
     <link rel="stylesheet"   href="{{url('frontend/assets/css/final.css')}}" >
     <link rel="stylesheet" href="{{url('frontend/assets/css/animation.css')}}">
     <link rel="stylesheet" href=" {{ url('frontend/assets/css/animation.css')}}">
     <!-- ========================================================== -->
     


   <title>مسك </title>
    <style>

      
    </style>
</head>
<body  >
    <!-- Start Header -->
<div class="header1">
    <!--  Start Top Header -->
    <div class="top-Header">
        <div class="container">
            <div class="row social-top ">
                <div class="  col-md-6  col-sm-12  text-center">
                    <p> <i  class="fa fa-phone" > </i> {{App\Setting::getSetting('sitePhone1')}}</p>                    
                </div>
                <div class=" col-md-6 col-sm-12 ">
                    <nav class="nav justify-content-center">
                        <a  href="{{url(   App\Setting::getSetting('facebookURL')  )}}" class="nav-link"><i  class="fa fa-facebook " > </i></a>
                        <a  href="{{url(   App\Setting::getSetting('twitterURL')  )}}" class="nav-link"><i  class="fa fa-twitter " > </i></a>
                        <a   href="{{url(   App\Setting::getSetting('googlePlusURL')  )}}" class="nav-link"><i  class="fa fa-google-plus " > </i></a> 
                        <a  href="{{url(   App\Setting::getSetting('youTubeURL')  )}}"  class="nav-link"><i  class="fa fa fa-youtube " > </i></a>    
                    </nav>
                </div>
            </div>
            
        </div>
    </div>
    <!-- End Top Header -->
    <!-- navbar -->
        <nav class="navbar navbar-icon-top navbar-expand-lg  navbar-dark bg-dark">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- menu right --> 
                <ul class="navbar-nav  navbar-right"> 
            
                    <!-- nav-item -->
                    <!-- Redirect to home -->
                   
                    
                    <!-- Redirect to home -->
                    
                    
                      @if(Auth::check() && Auth::User()->Role == 0 )                          
                        <li class="nav-item dropdown ml-auto">
                            <a class="nav-link dropdown-toggle" href="#" id="login" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                أهلا &nbsp; {{Auth::User()->name  }} 
                                <i  class="fa fa-heart-o  fa-2x" ></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="login">                                    
                                <a class="dropdown-item" href="{{url('logout')}}">  <i class="fa fa-fast-forward" style="margin-left:10px"></i> الخروج </a>
                            </div>                        
                        </li>                                        
                     @else               
                
                    <li class="nav-item dropdown ml-auto" style="border:0px solid #aaa">
                        <a class="nav-link dropdown-toggle " href="#" id="register" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i  class="fa fa-user fa-2x" >   <span style="font-size:12px">   </span></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="register">                                    
                            <a class="dropdown-item" href="{{url('login')}}">  <i class="fa fa-sign-in" style="margin-left:10px"></i>  الدخول </a>
                            <a class="dropdown-item" href="{{url('register')}}">  <i class="fa fa-user" style="margin-left:10px"></i> التسجيل  </a>                          
                        </div>
                    </li>
                    @endif
                    </ul>
                    <!-- menu right --> 
                    <!-- menu center --> 
                <ul class="navbar-nav  navbar-center"> 
                    <li class="nav-item ">
                        <a class="nav-link active" href="{{url('/')}}">
                        <i class="fa fa-home"></i>
                        الرئيسية
                        <span class="sr-only">(current)</span>
                        </a>
                    </li>
                
                        <!-- nav-item --> 
                        
                    <li class="nav-item">
                        <a class="nav-link " href="{{url('products')}}">
                                <i class="fa fa-th"></i>          
                        الأقسام
                        </a>
                    </li>
                        <!-- nav-item --> 
                    <li class="nav-item">
                            <a class="nav-link " href="{{url('products/latestPage')}}"> 
                                    <i class="fa fa-snowflake-o"></i>         
                            وصل حديـثا
                            </a>
                    </li>
                
                        <!-- nav-item --> 
                    <li class="nav-item  ">
                            <a class="nav-link " href="{{ url('products/mostSold')}}">
                            <i class="fa fa-trophy"></i>          
                            أعلى مبيـعا
                            </a>                              
                    </li>
                    <li class="nav-item  ">
                            <a class="nav-link " href="{{ url('products/mostRated')}}">
                            <i class="fa fa-star"></i>          
                            أعلى تقييما
                            </a>                              
                    </li>
          
                    <li class="nav-item">
                            <a   class="nav-link"  href="{{ url ('products/discount') }}">
                            <i  class="fa fa-gift  fa-3x"  > 
                            </i>تخفيض</a>
                    </li>
                    <!-- nav-item --> 
                    <li class="nav-item">
                        <a  href="{{url('wishList')}}" class="nav-link">
                            <i  class="fa fa-heart fa-5x" >
                                @if(  Auth::check() && Auth::User()->Role ==0 ) 
                                    <span  id="favoriteCount" class="badge badge-danger">
                                        {{App\Favorite::countWishes(   Auth::User()->id  )}}
                                    </span>
                                @endif
                            </i>المفضلة
                        </a>
                    </li>
                    <!-- nav-item --> 
                    <li class="nav-item">
                        <a  href="{{url('cart')}}" class="nav-link">
                            <i  class="fa fa-shopping-cart fa-5x" >
                            @if(  Auth::check() && Auth::User()->Role ==0 ) 
                                    <span class="badge badge-danger">
                                        {{App\Cart::CountCart(   Auth::User()->id  )}}                               
                                    </span>
                                @endif
                            </i>المشتريات
                        </a>
                    </li>        
                </ul>
                    <!-- menu rioght --> 
                    <!-- menu left -->  
                <ul class="navbar-nav  navbar-left"> 
                        <!-- search-form --> 
                
                        {!!Form::Open(['class'=>'form-inline my-2 my-lg-0' , 'method'=>'GET' , 'url'=>'products/searchPage'])  !!}  
                        <input class="form-control main-search mr-sm-2" name= "search" type="text" placeholder=" تستطيع  البحث باسم المنتج أو الموديل أو   القسم   " aria-label="Search">
                        <button class=" btn btn-form  mr-3 px-4" type="submit">البحـث</button>
                        {!!Form::Close() !!}
                
                            <!-- search-form -->
                </ul>
                    <!-- menu left --> 
            </div>
            <!-- collapce -->
        </nav>
    <!-- navbar -->
 </div> 
 <!-- header -->







