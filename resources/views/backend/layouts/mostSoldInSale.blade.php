@extends('backend.layouts.app')

@section('content')

<!--  -->

<div class="container border px-5"  >   
      <div class="row   ">
         <div class="text-center">
                   <h5 class="sectionTitle text-center ">   المنتجات الأكثر مبيعا فى كل تخفيض  </h3>                         
         </div>      
    </div>
</div>

<div class="  accordion" style="margin-top:0">
  <div class="container">   
        <div class="row">
                <div class="cart">
                    <div class=" container shopping-cart">  
                        <div class="shopping-cart-table" > 
                                    <!-- <div class="table-responsive"> -->
                                          <table  style="width:100%"  class="table table-responsive box-shadow  table-bordered px-5 pb-5 " style="border-top:3px solid pink;">
                                            <tr>
                                              <td colspan="6">
                                              <div class="login">
                                                  {!! Form::Open(['class'=>'form-group  box-shadow login'  , 'method' =>'GET'])!!}
                                                  <input  class="form-control mb-2" type="date" name="q" placeholder="اكتب تاريخ       "  value="@if(isset($_GET['q'])){{$_GET['q']}}@endif"> 
                                                  <input type="submit" class="btn get" value="بحث">
                                                  <span  class="px-5  font-color ">  تاريخ البحث   يقع  بين  تاريخ البداية و تاريخ النهاية </span>

                                                  {!! Form::Close() !!}
                                                </div>
                                              </td>
                                              
                                            </tr>

                                            <tr> 
                                                  <td colspan="4" class="text-center">
                                                        <h5 class="sectionTitle">                                                         
                                                        @if(Session::has('success'))                     
                                                          {{   Session::get('success')}}
                                                          @elseif(Session::has('error'))
                                                          {{ Session::get('error')}}
                                                          @endif                                                         
                                                        </h5>
                                                        
                                                  </td>                                                                                      
                                                  <td>  <h5 class="sectionTitle">  العدد  ({{ count ($data)}})</h5></td>
                                            </tr>
 <!-- ====================== if count >  0  show the rest of the table  -->
 @if(count($data)  >  0 )
                                           <!-- ====================== if count >  0  show the rest of the table  -->
                                            <tr class="main-bg">
                                                <th  colspan="2" class="title"  scope="col" width="80" >الرقم</th>

                                                <th class="title"  scope="col" width="300">تاريخ البداية </th>

                                                <th class="title"  scope="col" width="300">تاريخ النهاية </th>
                                                <th class="title"  scope="col" width="120"> نسبة الخصم </th>

                                          
                                            </tr>
                                            <tr>
                                @foreach($data as $key=>$sale)
                                            
                                                <td  colspan="2" @if ( App\Sale::isactive($sale->saleNo) == 'انتهى' )  class= "backg-not-active" @endif >{{$key+1}}  
                                                <span class="font-color mr-4">( {{ App\Sale::isactive($sale->saleNo) }} )</span>
                                                </td>
                                                  <td>{{App\Sale::rightDate($sale->startDate)  }}</td>
                                                  <td>{{App\Sale::rightDate($sale->endDate)  }}</td>
                                           

                                                    <td>{{ $sale->percentageValue}} %</td>
                                          
                                             </tr>
                                                    <?php 
                                                          $mostSoldInSale= App\Sale::mostSoldInSale($sale->endDate , $sale->startDate);
                                                                    // dd($mostSoldInSale);
                                                                    $itemsInsale=array();
                                                                    foreach($mostSoldInSale as $key => $singleItem){
                                                                      if(in_array ( $singleItem->code, json_decode($sale->itemsINsale)  ) ){
                                                                      $itemsInsale[]= $singleItem;
                                                                  }
                                                                  
                                                                }
                                                          //  dd($itemsInsale);
                                                    ?>
                                                 
                                        @if( count ($itemsInsale )   > 0 )

    
                                            <tr>
                                                <td colspan="6">
                                                          <div class="accordion-header" style="padding:15px"><i class="fa fa-chevron-down"></i>
                                            
                                                              <span class="ml-3 font-color">    المنتجات  الاكثر مبيعا  فى هذا  الخصم      </span>   <span class="font-color" >   ({{ count ($itemsInsale)}})</span>  
                                                        </div>
                                                        <!-- =========================== -->
                                                 
      
                                                        <div class="accordion-content">
                                                            <table class="table table-responsive box-shadow  table-bordered  pb-5 mt-5" style="border-top:3px solid pink;">
                                                                    <tr>
                                                                        <th   scope="col" width="50" >الرقم </th> 
                                                                        <th   scope="col" width="70" >الصورة </th> 
                                                                        <th   scope="col" width="70" > الكمية</th> 
                                                                        <th   scope="col" width="300">الاسم</th>
                                                                        <th   scope="col" width="70">   السعر قبل</th> 
                                                                        <th   scope="col" width="70">   الخصم  </th> 
                                                                        <th   scope="col" width="70">   السعر بعد  </th> 
                                                                    </tr>
                                                                    <tr>
                                                                    @foreach($itemsInsale as $key=>$item) 
                                                                


                                                                        <td>{{$key+1}}</td>
                                                                        <td>
                                                                            <img src=" {{ url( App\Itemimage::getImagesForItem($item->code) [0]) }}"  width="70 " height="70" alt=""> 
                                                                      
                                                                         </td> 
                                                                        <td>{{$item->totalQty}}</td> 
                                                                        <td>  <span class="font-color border py-2">    ( {{ $item->code  }}  )  </span>  {{App\Item::getItemName($item->code)}}</td> 
                                                                        <td>{{ App\Cart::getItemPrice($item->code)}}</td>
                                                                        <td>{{   $sale->percentageValue}}  % </td>

                                                                        <td>{{ App\Sale::priceAfterDiscount(     App\Cart::getItemPrice($item->code) ,    $sale->percentageValue )  }}  </td>
                                                                    </tr>                                       
                                                                  @endforeach                                        
                                                          </table>                      
                                                        </div> 
                                                        <!-- accordion-content -->                              
                                                 </td> 
                                                    <!--/TD  -->
                                            </tr>
                                            @endif
                                        @endforeach   
                                     
<!--==================================================   if the count (data)==> 0 ======================================  -->
        @else
        <!-- sale -->
                                <tr>                
                                    <td  colspan="3" style="width:100%" ><h5 class="sectionTitle">  عفوا لا يوجد تخفيضات </h5></td>                         
                                </tr>
        @endif
<!--==================================================   if the count   data ==0 ======================================  -->
                   </table>
                                    <!-- </div>        -->
                            
                        </div> 
                        <!--shopping cart table  -->
                                         
                    </div>  <!-- container -->

                 </div>    <!--   cart -->
             </div>

        </div>
        <!-- row -->
     
    </div>
    <!-- container -->
</div>
@endsection