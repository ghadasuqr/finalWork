@extends('backend.layouts.app')

@section('content')

<!--  -->
<!-- <div class="page"> -->
<div class="container" style="min-height:600px">
        <div class="row">
            
             <div class="col-md-12 col-sm-12">
                 <div class="shopping-cart-header main-bg text-center">
                   <h3 class="text-center">    الموديلات  </h3>
                   <i class="fa fa-star fa-2x"></i>
                </div>
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

@if(count($data)==0)
<div  class="text-right py-5 my-5"><h5 class="sectionTitle py-5 border "  >عفوا لا  يوجد نتايج    </h5></div>  

@else      
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

                <div class="cart">

                    <div class=" container shopping-cart">                            
                                                 
                        <div class="shopping-cart-table"> 

                                    <!-- <div class="table-responsive"> -->
                                          <table class="table table-responsive box-shadow  table-bordered px-5 pb-5 mt-5" style="border-top:3px solid pink;">
                                          <tr>
                                              <td colspan="6">
                                                <div class="login">
                                                  {!! Form::Open(['class'=>'form-group  box-shadow login'  , 'method' =>'GET'])!!}
                                                  <input  class="form-control mb-2" type="text" name="q" placeholder="البحث باسم الفئة او اسم الموديل "  value="@if(isset($_GET['q'])){{$_GET['q']}}@endif"> 
                                                  {!! Form::Close() !!}
                                                </div>
                                              </td>
                                              
                                            </tr>
                                           
                                            <tr>
                                                    <td class="text-right"> 
                                                    <a href="{{url('dashboard/models/create')}}" class="btn get" > أضافة موديل  جديد </a> </td>
                                                    <td colspan="4" class="text-center">
                                                         <h5 class="sectionTitle">                                                         
                                                         @if(Session::has('success'))                     
                                                            {{   Session::get('success')}}
                                                            @else
                                                            {{ Session::get('error')}}
                                                           @endif                                                         
                                                         </h5>
                                                    </td>
                                                    <td>
                                              <h5 class="sectionTitle">  العدد  ({{ count ($data)}})</h5> 
                                              </td>
                                            </tr>
                                            
                                            <tr class="main-bg">
                                                <th class="title"  scope="col" width="30" >الرقم</th>

                                                <th class="title"  scope="col" width="200">الفئة</th>

                                                <th class="title"  scope="col" width="200">الموديل</th>

                                                <th class="title"  scope="col" width="200" class="mr-2 px-2">تعديل</th>
                                                <th class="title"  scope="col" width="200"> اخفاء</th>
                                                <th class="title"  scope="col" width="200"> اعادة</th>

                                            </tr>
                                        
                                            @foreach($data as $key=>$model)
                                            <tr @if($model->active == 1) class="backg-not-active" @endif>
                                                <td>{{$key+1}}</td>
                                                  <td >{{App\category:: getNameCatById($model->categoryNo)}}</td>

                                                    <td>{{ $model->modelName}}</td>
                                                    <td class="text-right"> 
                                                    <a href="{{url('dashboard/models/edit/'.$model->modelNo)}}" class="btn btn-outline-warning px-3"> تعديل</a>
                                                    </td>

                                                    {!! Form::Open(['url' => 'dashboard/models/destroy/'.$model->modelNo ]) !!}

                                                    <td class="text-right"> 
                                                    <button class="btn btn-outline-danger"> × اخفاء</button>
                                                    </td>
                                                    {!! Form::Close()!!}
                                                    
                                                    {!! Form::Open(['url' => 'dashboard/models/show/'.$model->modelNo ]) !!}

                                                    <td class="text-right"> 
                                                    <button class="btn btn-outline-danger"> × اعادة</button>
                                                    </td>
                                                    {!! Form::Close()!!}
                                                    
                                            </tr>
                                       
                                          @endforeach                                        
                                        </table>
                                    <!-- </div>        -->
                            
                        </div> 
                        <!--shopping cart table  -->
                                         
                    </div>  <!-- container shopping cart -->

                 </div>    <!--   cart -->
             </div>
             <!-- cart -->
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

 @endif   
 <!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->
         
        </div>
        <!-- row -->
       
    </div>
    <!-- container -->
<!-- </div> -->
<!-- page -->
@endsection