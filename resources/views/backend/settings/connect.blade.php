@extends('backend.layouts.app')

@section('content')

<div class="settings">
    <div class="container  mt-5 text-right">

<!-- ===================================================== start  row 2============================================================= -->
<div class="row">  
            <div class="col-md-3"></div>

            <!-- start col-6 -->
              <div class="col-md-6 text-center">
                    <!-- login -->   
                        <div class="login mt-5">
                            <div class="formHeader ">
                                <h5 class="sectionTitle">    الاتصال  بالموقع </h5>
                            </div>
                            <div class="main-bg py-3">
                                <h5 class="title">    معلومات الاتصال </h5>
                            </div>                

                            {!! Form::Open(['class'=>'form-group  box-shadow login' , 'url' =>'dashboard/settings/connect' ]) !!}
                                <h5 class="infoTitle my-3 text-center">
                                @if(  Session::has('success')  )                    
                                    {{   Session::get('success')}}
                                @elseif(Session::has('error'))
                                {{   Session::get('error')}}
                                @elseif(Session::has('phone'))
                                {{   Session::get('phone')}}
                                @endif
                                </h5>

                                <h5 class="infoTitle my-3 text-center">
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
                                <!-- ======================================== -->
                                
                                <div class="text-right pr-2 "> <label class="font-color"  > رقم التليفون   الأساسي  </label> </div>
                                <input  class="form-control mb-2" type="text" value="{{App\Setting::getSetting('sitePhone1') }}" name="sitePhone1"  />
                               
                                <div class="text-right pr-2 "> <label class="font-color"  > رقم التليفون الثانى</label> </div>   
                                <input  class="form-control mb-2" type="text"   value="{{App\Setting::getSetting('sitePhone2') }}"  name="sitePhone2"  />

                                <div class="text-right pr-2 "> <label class="font-color"  > رقم التليفون   الثالث </label> </div>   
                                <input  class="form-control mb-2" type="text"   value="{{App\Setting::getSetting('sitePhone3') }}"  name="sitePhone3"  />

                                <div class="text-right pr-2 "> <label class="font-color"  > الميل</label> </div>   
                                <input  class="form-control mb-2" type="text" value="{{App\Setting::getSetting('Email') }}" name="Email"  />

                            <input   class=" btn get  mb-2" type="submit" name="addModel"  value=" تعديل  " />
                                    
                            {!! Form::Close()!!} 
                        </div>
                    <!-- login -->
                </div>
            <!-- end col-6 -->
            
            <div class="col-md-3"></div>
<!-- ===================================================== end   row 2============================================================= -->

</div><!--container-->
</div>

@endsection