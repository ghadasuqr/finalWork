
@extends('backend.layouts.app')

@section('content')

    <div class="container  mt-5 text-right">
        
        <div class="row">  
  
            <div class="col-md-12 text-center">
                <div class="login ">
                    <div class="formHeader ">
                        <h5 class="sectionTitle"> سؤال وجواب <h5>
                    </div>
                <div class="main-bg py-3">
                    <h5 class="title"> اكتب السؤال و الجواب</h5>
                    </div>                
                    
                
                    {!! Form::Open(['class'=>'form-group  box-shadow login' ])!!}

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
                        <input  class="form-control mb-2" type="text" name="question" value="{{ old ('question')}}" placeholder="السؤال  " />
                        <textarea name="answer" class="px-2"  style="width:100% ; height:100px" placeholder=" اكتب الاجابة هنا"> {{ old ('answer')}}</textarea>

                        <input   class=" btn get  mb-2" type="submit" name="addfq" value=" اضافة " />
                            
               
                    {!! Form::Close() !!}
            
                </div>
                    <!-- login -->
            </div>
            <!-- col-6 -->
        
        </div> <!--row-->
    </div><!--container-->

@endsection