@extends('backend.layouts.app')

@section('content')

<!--  -->
<div class="page">
    <div class="container " id="height" style="min-height:600px">
        <div class="row" > 
            
             <div class="col-md-12 col-sm-12">
                 <div class="shopping-cart-header main-bg text-center">
                   <h3 class="text-center">    المستخدمين  </h3>
                   <i class="fa fa-user fa-2x"></i>
                </div>
<!-- --------------------------------------------------------------------------------------- -->

@if(count($users)==0)
<div  class="text-right py-5 my-5"><h5 class="sectionTitle py-5  my-4 border "  >عفوا لا  يوجد نتايج    </h5></div>  

@else     
<!-- --------------------------------------------------------------------------------------- -->

                <div class="cart">

                    <div class=" container shopping-cart">                            
                                                 
                        <div class="shopping-cart-table"> 

                                    <!-- <div class="table-responsive"> -->
                                          <table class="table table-responsive box-shadow  table-bordered px-5 pb-5 mt-5" style="border-top:3px solid pink;">
                                          <tr>
                                              <td colspan="6">
                                                <div class="login">
                                                  {!! Form::Open(['class'=>'form-group  box-shadow login'  , 'method' =>'GET'])!!}
                                                  <input  class="form-control mb-2" type="text" name="q" placeholder="البحث  "  value="@if(isset($_GET['q'])){{$_GET['q']}}@endif"> 
                                                  {!! Form::Close() !!}
                                                </div>
                                              </td>
                                              
                                            </tr>
                                           
                                            <tr>
                                                    
                                                         <h5 class="sectionTitle">                                                         
                                                         @if(Session::has('success'))                     
                                                            {{   Session::get('success')}}
                                                            @else
                                                            {{ Session::get('error')}}
                                                           @endif                                                         
                                                         </h5>
                                                    </td>
                                                    <td>
                                              <h5 class="sectionTitle">  العدد  ({{ count ($users)}})</h5> 
                                              </td>
                                            </tr>
                                            
                                            <tr class="main-bg">
                                                <th class="title"  scope="col" width="30" >مسلسل</th>
                                                <th class="title"  scope="col" width="30" >الرقم</th>

                                                <th class="title"  scope="col" width="200">الاسم</th>

                                                <th class="title"  scope="col" width="200">الميل</th>
                                                <th class="title"  scope="col" width="200">المجموعة</th>

                                                <th class="title"  scope="col" width="200"> حجب</th>
                                                <th class="title"  scope="col" width="200"> تعديل</th>

                                            </tr>
                                        
                                            @foreach($users as $key=>$user)
                                            <tr @if($user->Role == 1) class="backg-not-active" @endif >
                                                <td>{{$key+1}}</td>
                                                <td>{{$user->id}}</td>
                                                  <td >{{ $user->name }}</td>

                                                    <td>{{ $user->mail}}</td>
                                                    <td>
                                                    <select  style="width:150px ;height:40px; ">

                                                        <option value="" disabled> اختر مجموعة </option>
                                                        <option value="0" @if(0 ==$user->Role) selected @endif>مستخدم</option>
                                                        <option value="1" @if(1 ==$user->Role) selected @endif>أدمن</option>
                                                        <option value="2" @if(2 ==$user->Role) selected @endif>توصيل</option>

                                                      </select>
                                                    </td>
                                                    

                                                    {!! Form::Open(['url' => 'dashboard/update/'.$user->id ]) !!}

                                                    <td class="text-right"> 
                                                    <button class="btn btn-outline-warning">  تعديل</button>
                                                    </td>
                                                    {!! Form::Close()!!}
                                                    {!! Form::Open(['url' => 'dashboard/block/'.$user->id ]) !!}

                                                    <td class="text-right"> 
                                                    <button class="btn btn-outline-danger"> × اخفاء</button>
                                                    </td>
                                                    {!! Form::Close()!!}
                                                    
                                                   
                                                    
                                            </tr>
                                       
                                          @endforeach                                        
                                        </table>
                                    <!-- </div>        -->
                            
                        </div> 
                        <!--shopping cart table  -->
                                         
                    </div>  <!-- container  shopping-->

                 </div>    <!--   cart -->
<!-- --------------------------------------------------------------------------------------- -->
@endif
<!-- --------------------------------------------------------------------------------------- -->

             </div>
             <!-- col-12 -->

        </div>
        <!-- row -->
       
    </div>
    <!-- container -->
</div>
@endsection