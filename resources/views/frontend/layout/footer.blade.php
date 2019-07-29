
<!-- Start Footer -->
<div class="footer">
    <div class="container">
        <div class="row ">
        
            <div class="col-sm-6 col-lg-3">       
                <ul>
                    <li>
                        <a href="{{url('fq')}}"><i class="fa fa-question" aria-hidden="true"></i>
                                    الأسئلة الشائعة                                  
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{url('products')}}"><i class="fa fa-th" aria-hidden="true"></i>
                            الأقسام
                            
                        </a>
                    </li>
                         
        
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3">       
                <ul>
                    <li>
                            <a href="{{url('products/mostRated')}}" ><i class="fa fa-star" aria-hidden="true"></i>
                            </i>
                                الأعلى تقييما                                  
                            </a>
                    </li>
                    
                    <li>
                        <a href="{{ url('products/mostSold') }}"><i class="fa fa-trophy"  aria-hidden="true"></i>
                            الأكثر مبيعا                            
                        </a>
                    </li>
                    <!-- <li> 
                        <a href="#"><i class="fa fa-spinner" aria-hidden="true"></i>
                          مـودرن                            
                        </a>
                    </li>                    -->
        
                </ul>
            </div>                   
            <div class="col-sm-6 col-lg-3">
                <ul>  
                        <!--  -->
                    <!-- <li>
                        <a href="#"><i class="fa fa-car" aria-hidden="true"></i>
                            خدمة التوصيل                            
                        </a>
                    </li>
                    <li> 
                        <a href="#"><i class="fa fa-user-o" aria-hidden="true"></i>
                        من نحن                            
                        </a>
                    </li>
                     -->
                     <li> 
                        <a href="{{url('products/latestPage')}}"><i  style=" transform: rotate(180deg);" class="fa fa-snowflake-o  " aria-hidden="true"></i>
                        وصـل حديثا                            
                        </a>
                    </li>  
                    <li>
                        <a href="{{url('products/discount') }}"> <i class="fa fa-gift"  aria-hidden="true"></i>
                        تخفيض
                        </a>
                    </li>        
                </ul>
            </div>
            <div class="col-sm-6  col-lg-3">            
                <ul class="list-unstyled">
                        
                    
                    <li>
                        <a href="#">    <i   class="fa fa-phone" aria-hidden="true"></i>
                       {{ App\Setting::getSetting('sitePhone2')}}
                                                     
                        </a>
                    </li>
                    

                        <li style="font-size:12px">
                            <a href="#"><i class="fa fa-envelope-o"  aria-hidden="true" style="font-size:12px"></i>
                                <a href="mailto:info@ghadasuqr6@gmail.com?subject=Contact">
                                   {{ App\Setting::getSetting('Email')}}
                                
                            </a>
                        </li>
                </ul>
            
            </div>
        
            
        </div>
        
    </div>
</div>
<!-- End Footer -->
<!-- ===============================   End footer ======================================= -->
<!-- ===============================   start copyright ======================================= -->

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
   
      
<!-- =============================== End  copyright ======================================= -->
<!-- =============================== Start  scroll to top ======================================= -->
   <!-- scroll-to-top -->
         <div class="scroll-to-top">	
            <i class="fa fa-chevron-up" ></i> 
        </div>
      <!--  scroll-to-top-->
<!-- =============================== End  scroll to top ======================================= -->
    


<script type="text/javascript" src="{{url('frontend/assets/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('frontend/assets/js/popper.min.js')}}"></script> 
<script type="text/javascript" src="{{url('frontend/assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('frontend/assets/js/main.js')}}"></script>
 
