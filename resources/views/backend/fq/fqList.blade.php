@extends('backend.layouts.app')

@section('content')

<div class="container"> 
        <!-- row -->
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

@if(count($data)==0)
<div class=" py-5">
<div  class="text-right py-5 my-5"><h5 class="sectionTitle py-5 my-5 border "  >عفوا لا  يوجد نتايج    </h5></div>  
</div>
@else      
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

        <div class="row">
            <div class="col-sm-12">
      

<!-- accordion -->
        <div class="accordion box-shadow text-right">
        <!--  -->
    
<div style="display:flex;justify-content:space-between">
        <a href="{{url('dashboard/fq/create')}}" class="btn get" style="margin-top:0" > أضافة سؤال  جديد </a> 
            <span class="py-1">
                @if(Session::has('success'))
                {{ Session::get('success')}}
                @elseif(Session::has('error'))
                {{  Session::get('error')}}
                @endif


                
            </span>
        <span class="btn get" style="margin-top:0" > العدد  ( {{ count($data)}} ) </span> 
        </div>
        <!--  -->
                <div class="accordion-title pt-3 main-bg" style="margin-top:6px">   
                        <h3 class=" text-shadow responsive "> الاسئلة الشائعة   </h3> 
                        <i class="fa fa-question-circle-o   fa-flip-horizontal mr-3 text-shadow " ></i>
                </div>  
                 
                @foreach($data as $key=> $row)
                <div class="accordion-header"><i class="fa fa-chevron-down"></i>
                    <span class="ml-3">({{$key+1}})</span>
                    {{$row->question}}
                </div>
                <div class="accordion-content">
                    <p>{{ $row->answer}}</p>
                    <!-- edit destroy butons -->
                    <div   style="display:flex ;justify-content:space-between">                       
                        <a href="{{url('dashboard/fq/edit/'.$row->id)}}"> <button class="btn get px-3 "> تعديل</button></a>
                        {!! Form::Open(['url' => 'dashboard/fq/destroy/'.$row->id ]) !!}
                            <button class="btn btn-outline-danger mx-5"> × حذف</button>
                        {!! Form::Close() !!}
                    </div> 
                    <!-- edit destroy butons -->
                </div>
                <!-- content -->
                @endforeach
          

            <!-- search -->
            <div class="login " style="border-top:2px solid #fc3e3e80">
            {!! Form::Open(['class'=>'form-group  box-shadow login'  , 'method' =>'GET'])!!}
            <input  class="form-control mb-2" type="text" name="q" placeholder="  اكتب اى كلمة  من السؤال او الجواب للبحث عنها  "  value="@if(isset($_GET['q'])){{$_GET['q']}}@endif"> 
            {!! Form::Close() !!}
            </div>
            <!-- search -->
         
        </div>
        <!-- accordion -->
        

         </div>
         <!-- col-sm-12 -->
    </div>
    <!-- row -->
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

@endif   
 <!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

</div> 
<!-- container -->

@endsection