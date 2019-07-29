@extends('frontend.layout.app')
@section('content')

<div class="container  mt-5 text-right">
      
    <div class="row">  
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <div class="login ">
                <div class="formHeader ">
                    <h5 class="sectionTitle"> تغيير كلمة المرور</h5>
                </div>
            <div class="main-bg py-3">
                <h5 class="title">أدخل كلمة السر الجديدة   </h5>
                </div>
                        
                {!!Form::Open(['class' =>'form-group  box-shadow login'])  !!}
                <h5 class="infoTitle  ">
            
                @if( Session::has('cherror')  )
                        {{  Session::get('cherror')  }}
                @endif
                @if ($errors->any())
                 <div class="box-shadow py-2">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="list-item my-2">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                </h5>
                
                    <input   class="form-control mb-2" type="password" name="password"  placeholder="كلمة السر  الجديدة" />

                    <input    class="form-control  mb-2" type="password" name="confirmpassword"  placeholder="تأكيد كلمة السر " />

                    
                    <input   class=" btn get  mb-2" type="submit" name="sendCode" value=" ارسال" />
                   
                    {!!Form::Close()!!} 

            </div>
                <!-- login -->
        </div>
        <!-- col-6 -->
        <div class="col-md-3"></div>
     </div> <!--row-->
</div><!--container-->
@endsection