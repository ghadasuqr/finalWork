@extends('backend.layouts.app')

@section('content')

<!--  -->
<div class=" accordion" style="margin-top:0" >
<div class="container" style="min-height:200px">
        <div class="row">
                    
             <div class="col-md-12 col-sm-12">
                 <div class="shopping-cart-header main-bg text-center">
                   <h3 class="text-center">    التخفيضات  </h3>                         
                   <i class="fa fa-gift fa-2x" style="color:#fff"></i>
                </div>

                <div class="cart">

                    <div class=" container shopping-cart">                            
                                                 
                        <div class="shopping-cart-table"> 
                                    <!-- <div class="table-responsive"> -->
                                          <table   class="table table-responsive box-shadow  table-bordered px-5 pb-5 mt-5" style="border-top:3px solid pink;">
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
                                                  <td class="text-right"><a href="{{url('dashboard/sales/create')}}" class="btn get" > أضافة تخفيض   </a> </td>
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
                                                <th class="title"  scope="col" width="30" >الرقم</th>

                                                <th class="title"  scope="col" width="200">تاريخ البداية </th>

                                                <th class="title"  scope="col" width="200">تاريخ النهاية </th>
                                                <th class="title"  scope="col" width="120">  الخصم </th>

                                                <th class="title"  scope="col" width="100" class="mr-2 px-2">تعديل</th>
                                                <th class="title"  scope="col" width="100"> حـذف</th>

                                            </tr>
                                            @foreach($data as $key=>$sale)

                                            <tr class="border-top2">
                                            
                                                  <td  @if ( App\Sale::isactive($sale->saleNo) == 'انتهى' )  class= "backg-not-active" @endif >{{$key+1}}  
                                                    <span class="font-color mr-4">( {{ App\Sale::isactive($sale->saleNo) }} )</span>
                                                  </td>
                                                  <td>{{App\Sale::rightDate($sale->startDate)  }}</td>
                                                  <td>{{App\Sale::rightDate($sale->endDate)  }}</td>
                                           

                                                    <td>{{ $sale->percentageValue}} %</td>
                                          
                                                    <td class="text-right"> 
                                                    <a href="{{url('dashboard/sales/edit/'.$sale->saleNo)}}" class="btn btn-outline-warning px-3"> تعديل</a>
                                                    </td>

                                                    {!! Form::Open(['url' => 'dashboard/sales/destroy/'.$sale->saleNo ]) !!}

                                                    <td class="text-right"> 
                                                    <button class="btn btn-outline-danger"> × حذف</button>
                                                    </td>
                                                    {!! Form::Close()!!}
                                                    
                                             </tr>

                                              <?php $itemsINsale= App\Sale::itemsINsale($sale->saleNo) ; ?>
                                              <tr>
                                                  @if( count ($itemsINsale )   > 0 )
                                              
                                                    <td colspan="6">
                                                            <div class="accordion-header" style="padding:15px"><i class="fa fa-chevron-down"></i>
                                                
                                                                  <span class="ml-3 font-color">    المنتجات  فى الخصم      </span>   <span class="font-color" >   ({{ count ($itemsINsale)}})</span>  
                                                            </div>
                                                            <!-- =========================== -->
                                                    
          
                                                            <div class="accordion-content">
                                                                <table class="table table-responsive box-shadow  table-bordered  pb-5 mt-5" style="border-top:3px solid pink;">
                                                                        <tr>
                                                                            <th   scope="col" width="100" >الرقم </th> 
                                                                            <th   scope="col" width="70" >الصورة </th> 
                                                                            <th   scope="col" width="200">الموديل</th>
                                                                            <th   scope="col" width="400">الاسم</th> 
                                                                            <th   scope="col" width="120">   السعر قبل</th> 
                                                                            <th   scope="col" width="120">   السعر بعد </th> 
                                                                        </tr>
                                                                        <tr>
                                                                        @foreach(App\Sale::itemsINsale($sale->saleNo) as $key=>$code) 
                                                                          <?php  $item = App\Item::where('code' , $code)->first(); ?>

                                                                            <td>{{$key+1}}</td>
                                                                            <td>
                                                                                <img src=" {{ url( App\Itemimage::getImagesForItem($item->code) [0]) }}"  width="70 " height="70" alt=""> 
                                                                               </td> 
                                                                            <td> {{ App\Imodel::getModeNamelById($item->modelNo)}}</td> 
                                                                            <td> <span class="font-color border py-2">    ( {{ $item->code  }}  )  </span>{{App\Item::getItemName($item->code)}}</td> 
                                                                            <td>{{$item->price}} <span class="font-color"> ج </span></td> 
                                                                            <td>{{$item->price - ($item->price * $sale->percentageValue) / 100  }}  <span class="font-color"> ج </span></td> 
                                                                        </tr>                                       
                                                                      @endforeach                                        
                                                              </table>                      
                                                            </div> 
                                                                <!-- accordion-content -->                              
                                                        </td> 
                                                            <!--/TD  -->
                                                    @endif
      
                                                </tr>
                                             
      @endforeach 
                                          
      <!--==================================================   if the count  > 0 ======================================  -->
          @else
                              
                 <tr>   <td   style="width:100%" ><h5 class="sectionTitle">  عفوا لا يوجد تخفيضات </h5></td>  </tr>                         
                
          @endif
      <!--==================================================   if the count  > 0 ======================================  -->
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