@extends('backend.layouts.app')

@section('content')

<div class="container  mt-5 text-right">
      
    <div class="row">  
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <div class="login ">
                <div class="formHeader ">
                    <h5 class="sectionTitle"> تعديل موديل</h5>
                </div>
            <div class="main-bg py-3">
                <h5 class="title">   عدل اسم الموديل أو الفئة</h5>
                </div>                
                
            
                {!! Form::Open(['class'=>'form-group  box-shadow login' ])!!}

                <h5 class="infoTitle my-3 text-center">
                
                     @if(  Session::has('errorName')  )                    
                        {{   Session::get('errorName')}}
                    @elseif(Session::has('foundForCat'))
                    {{   Session::get('foundForCat')}}
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
                    <div class="text-right py-2 px-2 border">
                    <span  class="ml-3">اختر فئة </span>
                        <select  style="width:150px ;height:40px; " name="category" id="category" >

                                @foreach(App\category::get() as $cat)
                                    <option value="{{$cat->categoryNo}} "
                                      @if($model->categoryNo == $cat->categoryNo) selected @endif  >
                                      {{ $cat->categoryName}}
                                    </option>
                                        
                                @endforeach                     
                        </select>
                    </div>
                    <!-- ============================================= -->
                        
                    <input  class="form-control mb-2" type="text" name="modelName" value="{{$model->modelName}}" />

                    
                    <input   class=" btn get  mb-2" type="submit" name="addModel" value=" تعديل " />
                         
                {!! Form::Close()!!} 
         
            </div>
                <!-- login -->
        </div>
        <!-- col-6 -->
        <div class="col-md-3"></div>
     </div> <!--row-->
</div><!--container-->

@endsection