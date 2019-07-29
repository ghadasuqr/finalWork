@extends('frontend.layout.app')
@section('content')
<div class="container  mt-5 text-right">
      
    <div class="row">  
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <div class="login ">
                <div class="formHeader ">
               
                    <h5 class="sectionTitle"> الدخول</h5>
                </div>
            <div class="main-bg py-3">
                <h5 class="title">من فضلك  اكتب بياناتك</h5>
                </div>                
                
            
                {!!Form::Open(['class' =>'form-group  box-shadow login' , 'url' =>'login' ,'method'=>'post'])  !!}
                <h5 class="infoTitle  ">
            
                @if( Session::has('success')  )
                        {{  Session::get('success')  }}
                @endif
                @if( Session::has('error')  )
                        {{  Session::get('error')  }}
                @endif

                @if ($errors->any())
                 <div class="border py-2">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="list-item my-2">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                </h5>

                        
                    <input  class="form-control mb-2" type="text" name="mail"  value ="{{old('mail')}}" placeholder="البريد الالكترونى " />
                    <input   class="form-control mb-2" type="password" name="password"   placeholder="كلمة السر " />

                    
                    <input   class=" btn get  mb-2" type="submit" name="login" value=" دخول " />
                         
                {!!Form::Close()!!} 
                <div class="py-3">
                        <strong> هل نسيت كلمة المرور ؟    </strong> 
                        <a   href="{{url('forgetPassword')}}" > تغيير كلمة المرور  من هنا </a>
                </div>
            </div>
                <!-- login -->
        </div>
        <!-- col-6 -->
        <div class="col-md-3"></div>
     </div> <!--row-->
</div><!--container-->
@endsection