
@extends('backend.layouts.app')

@section('content')
<!--  -->
    <div class="container  mt-5 text-right">
        
        <div class="row">  
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">
                <div class="login ">
                    <div class="formHeader ">
                        <h5 class="sectionTitle"> إضافة فئـة</h5>
                    </div>
                <div class="main-bg py-3">
                    <h5 class="title">   اكتب اسم الفئة</h5>
                    </div>                
                    
                
                    {!! Form::Open(['class'=>'form-group  box-shadow login' ])!!}

                    <h5 class="infoTitle my-3 text-center"> 
                        @if(Session::has('msgCategory'))                     
                            {{   Session::get('msgCategory')}}
                          @endif
                        </h5>
                            <!--  -->

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
                        <input  class="form-control mb-2" type="text" name="categoryName" value="{{ old('categoryName') }}" placeholder="اسم الفئة  " />

                        <input   class=" btn get  mb-2" type="submit" name="addCat" value=" اضافة " />
                            
               
                    {!! Form::Close() !!}
            
                </div>
                    <!-- login -->
            </div>
            <!-- col-6 -->
            <div class="col-md-3"></div>
        </div> <!--row-->
    </div><!--container-->
<!-- </div> -->

@endsection