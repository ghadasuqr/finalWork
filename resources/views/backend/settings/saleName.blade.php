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
                                <h5 class="sectionTitle">     اسم التخفيض الجارى  </h5>
                            </div>
                            <div class="main-bg py-3">
                                <h5 class="title">    معلومات الاتصال </h5>
                            </div>                

                            {!! Form::Open(['class'=>'form-group  box-shadow login' , 'url' =>'dashboard/settings/saleName' ]) !!}
                                <h5 class="infoTitle my-3 text-center">
                                @if(  Session::has('success')  )                    
                                    {{   Session::get('success')}}
                                @elseif(Session::has('error'))
                                {{   Session::get('error')}}
                        
                                @endif
                                </h5>

                                <!-- ======================================== -->
                            

                                <div class="text-right pr-2 "> <label class="font-color"  > اسم التحفيض الحالى </label> </div>

                                <select class="form-control mb-4" name="saleName" >
                                <option value="">{{App\Setting::getSetting('saleName') }}</option>
                             
                                        @foreach(App\Name::saleNames() as $saleName )
                                        <option value="{{$saleName->nameId}}" >{{ $saleName->nameSale}}</option>
                                         @endforeach
                                </select>
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