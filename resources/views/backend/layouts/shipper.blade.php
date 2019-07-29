@extends('backend.layouts.appShipper')
@section('content')
<!-- =============================================================================== -->


<!-- =============================================================================== -->
<div class="page">
    <div class="container">
        <div class="row">
            
             <div class="col-md-12 col-sm-12">
                 <div class="shopping-cart-header main-bg text-center">
                   <h3 class="text-center">        موظف التوصيل    <span class="mr-3">  {{ Auth::User()->name}} </span></h3>
                   <i class="fa fa-star-o fa-2x"></i>
                </div>
           
                <div class="cart">

                    <div class=" container shopping-cart">                            
<!--  befor showing table-->
@if(count($data)==0)
  <div  class="text-right"><h5 class="sectionTitle  " >لا يوجد طلبات   للتحقق </h5></div>  
@else   
<!--  -->                                                  
                        <div class="shopping-cart-table"> 
                                    <!-- <div class="table-responsive"> -->
                                          <table class="table table-responsive box-shadow  table-bordered px-5  " style="border-top:3px solid pink;">
                                          <tr>
                                              <td colspan="7">
                                                <div class="login">
                                                  {!! Form::Open(['class'=>'form-group  box-shadow login'  , 'method' =>'GET'])!!}
                                                  <input  class="form-control mb-2" type="text" name="q" placeholder="البحث    برقم الفاتورة  "  value="@if(isset($_GET['q'])){{$_GET['q']}}@endif"> 
                                                  {!! Form::Close() !!}
                                                </div>
                                              </td>
                                              
                                            </tr>
                                           
                                            <tr>
                                                    
                                                    <td colspan="6" class="text-center">
                                                         <h5 class="sectionTitle">                                                         
                                                         @if(Session::has('success'))                     
                                                    
                                                     
                                                             {{ Session::get('success') 
                                                              }}
                                                             
                                                           
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
                                                <th class="title"  scope="col" width="50" >مسلسل</th>
                                                <th class="title"  scope="col" width="250">رقم الطلب </th>
                                                <th class="title"  scope="col" width="300">اسم المستخدم </th>                                             
                                                <th class="title"  scope="col" width="300">التاريخ  </th>                                          
                                                <th class="title"  scope="col" width="100"> تفاصيل  </th>
                                                <th class="title"  scope="col" width="100"> فاتورة  </th>
                                                <th class="title"  scope="col" width="100"> تاكيد الدفع  </th>
                                 

 
                                            </tr>
                                            <tr>
                                            @foreach($data as $key=>$order)
                                            
                                                <td>{{$key+1}}</td>
                                                  <td>{{$order->orderNo}}</td>

                                                    <td>{{App\User::getNameById($order->user_id) }}</td>
                                                
                                                    <td> {{ App\Sale::rightDate($order->created_at)  }}                                                    </td>


                                                    <td class="text-right"> 
                                                    <a href="{{url('dashboard/shipper/detailsToShipper/'.$order->orderNo)}}" class="btn btn-outline-warning px-1"><i class="fa fa-eye"></i> تفاصيل</a>
                                                    </td>
                                                    <td class="text-right"> 
                                                    <a href="{{url('dashboard/shipper/invoiceToShipper/'.$order->orderNo)}}" class="btn  get  px-1" style="margin-top:0"><i class="fa fa-vcard"></i> فاتورة</a>
                                                    </td>
                                                    {!! Form::Open(['url' => 'dashboard/shipper/ConfirmPaid/'.$order->orderNo])!!}
                                                    <td class="h5">
                                                        <button  class="get btn" type="submit"  style="margin-top:0 ">
                                                        <i class="fa fa-check ml-3"></i> تأكيد </button>
                                                     </td>
                                                    {!! Form::Close() !!}
                                                              
                                                    
                                            </tr>
                                       
                                            @endforeach                                        
                                        </table>
                                    <!-- </div>        -->
                            
                        </div> 
                        <!--shopping cart table  -->
<!--  if count(data) ==0 -->
@endif
<!--after showing table  -->                       
                                         
                    </div>  <!-- container -->

                 </div>    <!--   cart -->
             </div>
        </div>
        
    </div>
</div>
@endsection