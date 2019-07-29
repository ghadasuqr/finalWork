@extends('backend.layouts.app')

@section('content')

<!--  -->
<!-- <div class="page"> -->
    <div class="container">
        <div class="row">
            
             <div class="col-md-12 col-sm-12">
                 <div class="shopping-cart-header main-bg text-center">
                   <h3 class="text-center">   كافة   الطلبات  </h3>
                   <i class="fa fa-server fa-2x"></i>
              </div>
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

@if(count($data)==0)
<div  class="text-right py-5 my-5"><h5 class="sectionTitle py-5  my-4 border "  >عفوا لا  يوجد نتايج    </h5></div>  

@else      
<!------------------------------------------------------------------------------------------------------------------------------->
                <div class="cart">

                    <div class=" container shopping-cart">                            
                                                 
                        <div class="shopping-cart-table"> 
                                    <!-- <div class="table-responsive"> -->
                                          <table class="table table-responsive box-shadow  table-bordered px-5  " >
                                          <tr>
                                              <td colspan="9">
                                                <div class="login">
                                                  {!! Form::Open(['class'=>'form-group  box-shadow login'  , 'method' =>'GET'])!!}
                                                  <input  class="form-control mb-2" type="text" name="q" placeholder="البحث عن رقم الطلب  "  value="@if(isset($_GET['q'])){{$_GET['q']}}@endif"> 
                                                  {!! Form::Close() !!}
                                                </div>
                                              </td>
                                              
                                            </tr>
                                           
                                            <tr>
                                                    
                                                    <td colspan="8" class="text-center">
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
                                                <th class="title"  scope="col" width="200" >مسلسل</th>
                                                <th class="title"  scope="col" width="250">رقم  </th>
                                                <th class="title"  scope="col" width="500">اسم المستخدم </th>
                                                <th class="title"  scope="col" width="200">الموظف </th>
                                                <th class="title"  scope="col" width="100">الحالة  </th>
                                                <th class="title"  scope="col" width="420">التاريخ </th>
                                                <th class="title"  scope="col" width="70">الدفع </th>
                                                <th class="title"  scope="col" width="90"> تفاصيل  </th>
                                                <th class="title"  scope="col" width="90"> حذف  </th>

                                            </tr>
                                            <tr>
                                            @foreach($data as $key=>$order)
                                            
                                                <td>{{$key+1}}</td>
                                                  <td>{{$order->orderNo}}</td>

                                                    <td>{{ App\User::getNameById($order->user_id) }}</td>
                                                    <td>{{App\User::getShipperById($order->shipperNo)}}</td>
                                                    <td>{{App\Order::status($order->status)}}</td>
                                                    <td> {{ App\Sale::rightDate($order->created_at)  }}   </td>
                                                    <td>{{App\Order::isReturned($order->isReturned)}}
                                                    {{App\Order::isPaid($order->isPaid)}}

                                                    
                                                    </td>


                                                    <td class="text-right"> 
                                                    <a href="{{url('dashboard/orders/detail/'.$order->orderNo)}}" class="btn btn-outline-warning px-1"><i class="fa fa-eye"></i> تفاصيل</a>
                                                    </td>
                                                    {!! Form::Open(['url' => 'dashboard/orders/delete/'.$order->orderNo ]) !!}

                                                    <td class="text-right"> 

                                                    <button class="btn btn-outline-danger"> × حذف</button>
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
       @if( count ($data) >0  )
        <div style=" display:flex ; justify-content:center ;width:100%">
                <div class="col-md-4 text-center  " style=" display:flex ; justify-content:center;width:100%">
                    {!! $data->links() !!}
                </div>
        </div>
        @endif
    <!-- pagination -->

             </div>
             <!-- col-12 -->
        </div>
        <!-- row -->

        
    </div>
    <!-- conbtainer -->
<!-- </div> -->
<!-- page -->
@endsection