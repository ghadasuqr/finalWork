@extends('frontend.layout.app')
@section('content')
<div class="container  mt-5 text-right" style="min-height:200px">
      
    <div class="row">  
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <div class="login ">
                <div class="formHeader ">
             
                    @if($blocked)
                    <h5 class="sectionTitle my-5 py-5 text-center " id="ifNotRegistered"> 
                  <p>
                  
                 لا تستطيع  الشراء  من  الموقع   فقد تم حظر حسابك    </p>
                  <p>   يرجى الاتصال بالادارة لإعادة  تفعيل الحساب    </p>
                    </h5>
                    @endif
                </div>
             
            </div>
                <!-- login -->
        </div>
        <!-- col-6 -->
        <div class="col-md-3"></div>
     </div> <!--row-->
</div><!--container-->
@endsection