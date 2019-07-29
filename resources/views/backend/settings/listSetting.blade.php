@extends('backend.layouts.app')

@section('content')

<div class="settings">
    <div class="container  mt-5 text-right">
        
        <div class="row">  
            <div class="col-md-3"></div>
             <!-- col-6 -->
                <div class="col-md-6 text-center">
                     <!-- login -->
                        <div class="login mb-3">
                                <div class="formHeader ">
                                    <h5 class="sectionTitle"> تعديل  متغيرات الموقع</h5>
                                </div>
                                <div class="main-bg py-3">
                                    <h5 class="title">  روابط الموقع</h5>
                                </div>                

                                {!! Form::Open(['class'=>'form-group  box-shadow login' , 'url' =>'dashboard/settings/updateURL' ]) !!}
                                    <h5 class="infoTitle my-3 text-center">
                                    @if(  Session::has('success')  )                    
                                        {{   Session::get('success')}}
                                    @elseif(Session::has('error'))
                                    {{   Session::get('error')}}
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
                                    
                                    <div class="text-right pr-2 "> <label class="font-color"  >رابط الفيسبوك </label> </div>
                                    <input  class="form-control mb-2" type="text" value="{{App\Setting::getSetting('facebookURL') }}" name="facebookURL"  />
                                    <div class="text-right pr-2 "> <label class="font-color"  >رابط تويتر</label> </div>   
                                    <input  class="form-control mb-2" type="text"   value="{{App\Setting::getSetting('twitterURL') }}"  name="twitterURL"  />
                                    <div class="text-right pr-2 "> <label class="font-color"  >رابط جوجل بلس</label> </div>   
                                    <input  class="form-control mb-2" type="text" value="{{App\Setting::getSetting('googlePlusURL') }}" name="googlePlusURL"  />

                                
                                    <div class="text-right pr-2 "> <label class="font-color"  >رابط اليوتيوب </label> </div>   

                                    <input  class="form-control mb-2" type="text" value="{{App\Setting::getSetting('youTubeURL') }}"  name="youTubeURL" />

                                <input   class=" btn get  mb-2" type="submit" name="addModel"  value=" تعديل  " />
                                        
                                {!! Form::Close()!!} 
                            </div>
                        <!-- login -->
                 </div>         
            <!-- end col-6 -->
      
            <div class="col-md-3"></div>
        </div> <!--row-->



    </div><!--container-->
</div>

@endsection