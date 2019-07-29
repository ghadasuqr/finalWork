@extends('backend.layouts.app')
@section('content')

<!--=========================================================================================================-->
	
<div class="container  my-5">
<div class="row">
        <!-- show message after send order -->
<!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^  hide  invoice in error message   -->

              
            
 <!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^  hide  invoice in error message  -->






<div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row ">
                        <div class="col-md-6">
                            <h5 class="sectionTitle  text-right px-5" > شركة مسك  لملابس المحجبات</h5>
                     
                        </div>

                        <div class="col-md-6 text-center px-5 pt-3">
                            <p class="font-weight-bold mb-1">فاتورة رقم   #{{ $id }}</p>
                            <p class="font-color ml-3">بتاريخ :{{ App\Order::orderDate($id) }}</p>                     
                            <p class="SectionTitle ml-3" > {{ App\Order::retuneOrder($id) }}</p>

                        </div>
                    </div>

                    <hr class="my-2 color-font">
<!-- ================================================================== -->
                    <div class="row   p-3">
                        <div class="col-md-6 text-right px-5">
                            <p class="font-weight-bold mb-4"> <span class=" border-bottom py-3"> تفاصيل   الشحن  </span> </p>
                            <p class="mb-1"> <span class="font-color ml-3"> الاســـم :</span> {{App\Order::userInfo($id)->receiverName}}</p>
                            <p class="mb-1"><span class="font-color  ml-3"> التليفون :</span>{{App\Order::userInfo($id)->receiverPhone}}</p>
                            <p class="mb-1"><span class="font-color ml-3"> البلــــد :</span>{{App\Order::userInfo($id)->country}}</p>
                            <p class="mb-1"><span class="font-color ml-3"> المحافظة :</span>{{App\Order::userInfo($id)->city}}</p>
                            <p class="mb-1"><span class="font-color ml-3"> المديــنة :</span> {{App\Order::userInfo($id)->town}}</p>
                            <p class="mb-1"><span class="font-color ml-3"> العنوان :</span>{{App\Order::userInfo($id)->address}}</p>
                            
                        </div>

                        <div class="col-md-6  px-5 text-center px-5 ">
                            <p class="font-weight-bold mb-4 "> <span class=" border-bottom py-3"> تفاصيل  الفاتورة </span> </p>
                            <p class="mb-1"><span class="font-color ml-3 ">طريقة الدفع  : </span> كاش</p>
                            <p class="mb-1"><span class="font-color mi-3">اسم العميل : </span> {{App\Order::userNameOrder($id)}}  </p>
                        </div>
                    </div>
<!-- ============================================================================================================================================ -->
<!-- ======================================================================================================================================================= -->
                   <div class="row px-5 pt-2">
                        <div class="col-md-12">
                            <table class="table">
                
                            @if(App\Order::showHead($id))
                               
                           
                                <thead class="border-top-bottom">
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">الرقم</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الموديل</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الاسم</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الكمية</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">اللون </th>
                                        <th class="border-0 text-uppercase small font-weight-bold">المقاس</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">السعر    </th>                                  
                                          <th class="border-0 text-uppercase small font-weight-bold">التخفيض للوحدة  </th>
                                          <th class="border-0 text-uppercase small font-weight-bold">  السعر بعد التخفيض  </th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الاجمالى </th>
                                    </tr>
                                </thead>
                                @else
                            <h5 class="sectionTitle">
                            تم ارجاع كامل الطلب 
                            </h5>
                              
                                @endif   
                             
                                <tbody>
                                    @foreach(App\Order::cartIds($id) as $key=> $cartId  )                                   
                                    <!--  -->

                                    <!--  -->
                                        @foreach(App\Cart::where('id' , $cartId)->where('isReturned' , 0)->get() as $item)
                                     

                                            <tr>
                                              <td>{{ $item->code}}</td>
                                                <td>{{ App\Imodel::getModeNamelById($item->modelNo)  }}</td>
                                                <td>  {{  App\Item::getItemName($item->code) }} </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->color }}</td>
                                                <td>{{ $item->size }}</td>
                                                <td>{{ $item->price }} ج </td>   <!--  price before discount  -->
                                                <!-- discount -->
                                               <td>  {{ $item->ifDiscount }} %</td>
                     
                                                <td>{{ App\Cart::Price($item->price , $item->ifDiscount) }}</td>
                                                <td  colspan="2" class="text-left"> 
                                               <span>{{ App\Cart::subTotal($item->id ) }}</span><span class="price font-color">ج</span>
                                             </td>
                                                

                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
<!-- ===================================================================================== -->
                    <div class="d-flex flex-row-reverse bg-dark text-white p-2 ">
                        <div class="py-3 px-5 text-right">
                            <div class=" h4 mb-2">  <span class ="pl-4">   تكلفة الطلب</span>  {{App\Cart::TotalForOrder(App\Order::cartIds($id))}}   <span> ج</span> </div>

                            <div class=" h5 mb-3">  <span class ="pl-5">  تكلفة الشحن</span>  {{ App\Order::CostOfShip($id)}}   <span> ج</span>    </div>
                            <div class="h2 font-weight-light">   <span class ="pr-3 border-top" > الاجمالى   </span>
                                <span id="overAllTotal"class ="px-3  border-top"> {{App\Cart::TotalForOrder(App\Order::cartIds($id))  +  App\Order::CostOfShip($id)  }}  ج </span>
                                <!-- <span class ="pr-3 border-top"> ج</span> -->
                            </div>
                    </div>
                    <!--flex  -->
                    </div>
                </div>         <!-- card body-->
         
            </div>   <!-- card -->  

        </div>      <!-- col-12 -->    

<!-- ------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------- -->
<!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^  hide  invoice in error message  -->

<!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^  hide  invoice in error message  -->

</div>          <!-- row -->

</div>     <!-- container -->   
<!-- javascript ti calculate  overall  total -->
@endsection

