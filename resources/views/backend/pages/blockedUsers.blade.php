@extends('backend.layouts.app')

@section('content')

<!--  -->
<!-- <div class="page"> -->
    <div class="container">
        <div class="row">
            
             <div class="col-md-12 col-sm-12">
                 <div class="shopping-cart-header main-bg text-center">
                   <h3 class="text-center">    المستخدمين  </h3>
                   <i class="fa fa-user-o fa-2x"></i>
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
                                                  <input  class="form-control mb-2" type="text" name="q" placeholder="البحث  بالميل او الاسم او الرقم "  value="@if(isset($_GET['q'])){{$_GET['q']}}@endif"> 
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
                                                <th class="title"  scope="col" width="200"> اعادة</th>

                                            </tr>
                                        
                                            @foreach($users as $key=>$user)
                                            <tr @if($user->blocked == 1) class="backg-not-active" @endif>
                                                <td>{{$key+1}}</td>
                                                <td>{{$user->id}}</td>
                                                  <td >{{ $user->name }}</td>

                                                    <td>{{ $user->mail}}</td>
                                                    <td>{{ App\User::groupUser($user->Role) }}</td>
                                                    

                                                    
                                                    
                                                    {!! Form::Open(['url' => 'dashboard/activate/'.$user->id ]) !!}

                                                    <td class="text-right"> 
                                                    <button class="btn  get" style="margin-top:0">  اعادة</button>
                                                    </td>
                                                    {!! Form::Close()!!}
                                                    
                                            </tr>
                                       
                                          @endforeach                                        
                                        </table>
                                    <!-- </div>        -->
                            
                        </div> 
                        <!--shopping cart table  -->
                                         
                    </div>  <!-- container -->

                 </div>    <!--   cart -->

<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

@endif   
 <!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->


       <!-- pagination -->
       @if( count ($users) >0  )
        <div style=" display:flex ; justify-content:center ;width:100%">
                <div class="col-md-4 text-center  " style=" display:flex ; justify-content:center;width:100%">
                    {!! $users->links() !!}
                </div>
        </div>
        @endif
    <!-- pagination -->
             </div>
        </div>

    
    </div>
<!-- </div> -->
@endsection