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
                <h5 class="title"> الرحاء الضغط على الرابط لتتغيير اكلمة المرور </h5>
                </div>
                        

                {!!Form::Open(['class' =>'form-group  box-shadow login'])  !!}
              
                <h5 class="infoTitle my-3 text-center"> 

                @if($errors->any())
                 <div class="box-shadow py-2">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="list-item my-2">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @elseif( Session::has('key')  )
                       <a href="{{url('changePassword/'.Session::get('key') )  }}">تغيير كلمة المرور</a>
                    @elseif( Session::has('error')  )
                        {{  Session::get('error')  }}
                        @elseif( Session::has('success')  )
                        {{  Session::get('success')  }}
              

                      @endif
                
                </h5>


                        

                    <input   class=" btn get  mb-2" type="submit" name="sendCode" value=" ارسال" />
                    {!!Form::Close()!!} 
                <div class="py-3">
                        <strong> هل تذكرت كلمة المرور ؟    </strong> 
                        <a   href="{{url('login')}}" > إلى صفحة الدخول  </a>
                </div>
          
            </div>
                <!-- login -->
        </div>
        <!-- col-6 -->
        <div class="col-md-3"></div>
     </div> <!--row-->
</div><!--container-->
@endsection