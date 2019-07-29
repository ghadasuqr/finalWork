@extends('backend.layouts.appShipper')
@section('content');
<!--  this page will  appear when shipper click on button تفاصيل in shipper page  -->
<div class="container ">
<div class="row">
        <div class="shopping-cart-header main-bg">
            <h3>  طلب  &nbsp; &nbsp;{{       App\User::getNameById($userInfo->userId)     }}   </h3>
           
                <i class="fa fa-shopping-cart fa-2x " ></i>  
        </div>
@if(count($cartIds)==0)
<div  class="text-right py-5 my-5"><h5 class="sectionTitle py-5  my-4 border "  >عفوا لا  يوجد نتايج    </h5></div>  
@else
        <div class="shopping-cart-table " style="display:flex;justify-content:center" >        
            <table class="table table-responsive box-shadow " style="padding:40px 120px">
                            <tr>
                                <td colspan="8" class="text-center">
                                    <h5 class="sectionTitle">                                                         
                                    @if(Session::has('success'))                     
                                    {{   Session::get('success')}}
                                    @elseif(Session::has('error'))
                                     {{ Session::get('error')}}
                                     @elseif(Session::has('request'))
                                     {{ Session::get('request')}}
                                    @endif                                                         
                                    </h5>
                                </td>
                            </tr>

                            <tr >
                                <th scope="col">  الرقم  </th>
                                <th scope="col" class="text-right pr-4"> تفاصيل    </th>
                                <th scope="col">  الموديل  </th> 
                                <th scope="col">  الكمية  </th>
                                <th scope="col">    قبل  </th>                            
                                <th scope="col">  تخفيض   </th>                            
                                <th scope="col">    بعد </th>                            

                                
                                <th scope="col" width="120"> اجمالى  </th>
                                <!-- must be before outer foreach -->
                      {!! Form::Open(['url' => 'dashboard/shipper/return/'.$orderNo ]) !!}
                            <?php 
                            if(Session::has ('disabled')){
                                //   Session::flash('disabled' , 'style="display:none"');

                                $disabled=Session::get('disabled');
                            }else {$disabled='';  }                       

                            ?>
                                <th>  <button   {{ $disabled}} class="btn btn-outline-danger px-3 mr-3     "> × تفعيل</button></th>                               
                          </tr>
                     
                        
                        <tbody>
                        <!-- data= favorite table  foe certain  authorized user  -->
                            @foreach($cartIds as $key=> $cartId) 
                            <!-- for each code in resulted collection give item info   -->
                            @foreach(App\Cart::where('id' , $cartId)->get() as $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <div  class="item-right">
                                                <div  class="item-img">
                                                    <img  style="width:100px ; height:100px" src="{{url(   App\Itemimage::getImagesForItem($item->code) [0] )  }}" alt="" /> 
                                                </div>
                                                <div class="item-info">     
                                                    <ul >                                                             
                                                            <li> <span class=" titl pl-5 font-color"  >الاسم</span ><span class="info"> {{App\Item::getItemName($item->code)}}  </span></li>
                                                            <li> <span class=" titl pl-5 font-color"  >اللون</span ><span class="info"> {{$item->color}}  </span></li>
                                                            <li> <span class=" titl pl-5 font-color"  >المقاس</span ><span class="info">{{ $item->size}}</span></li>
                                                    </ul>
                                                </div>
                                        </div>
                                    </td>
                                   
                                    <td class="text-right"> 
                                          <p class=" font-color ">الموديل</p>
                                        <span class="py-5 ">{{App\Imodel::getModeNamelById($item->modelNo)}}</span>
                                    </td>
                                    <td> ( {{$item->quantity}} )  </td>
                                    <td> 
                                        <div class="price-wrap"> 
                                            <var class="price"> {{$item->price}} </var> <span class="price font-color">ج</span>
                                        </div> <!-- price-wrap .// -->
                                    </td>
                                    <td>{{ $item->ifDiscount}}</td>
                                    <td> 
                                        <div class="price-wrap"> 
                                            <var class="price"> {{ App\Cart::Price($item->price , $item->ifDiscount) }} </var> <span class="price font-color">ج</span>
                                        </div> <!-- price-wrap .// -->
                                    </td>
                                    <td class="text-right"> 
                                            <span id ="totalOfItem_{{$item->code}}">{{ App\Cart::subTotal($item->id)}}</span><span class="price font-color">ج</span>
                                    </td>
                                    
                                    <td>
                                        <label class="parent_check">
                                        <input type="checkbox"  name="returnedItem{{$key}}" value="{{$cartId}}"  id="returnedItem{{$key}}">
                                            رجع  <span class="checkmark" ></span>
                                        </label>
                                    </td>                                        
          
                                </tr>
                                @endforeach
                            <!-- end item info -->
                            @endforeach
                            <!--  end collection for certain user  -->

                         {!! Form::Close() !!}
                         <!-- must be after  outerforeach -->

                            <tr class="border-top">
                                <td colspan="8"></td>
                        
                                <td>
                                        <label class="parent_check">
                                        <input type="checkbox" name="select-all" id="select-all" >
                                            الكل  <span class="checkmark" ></span>
                                        </label>
                                </td>  

                            </tr>
                           
                        </tbody>
<!-- ----------------------------------------------------------- -->
          @endif
<!-- ----------------------------------------------------------- -->
            </table>
            </div>        
        </div>

    </div>  <!--  row-->
    
</div> <!-- container --> 



<div class="all_items">
    <div class="container">
        <div class="row">            
            <div class="col-md-12 col-sm-12">
                
            
            
                                <table class="table  table-responsive   box-shadow  px-5  ">
                     
                                    <tbody style="width:100%">
                                    <tr ><td colspan="3">  <h3 class="sectionTitle">  بيانات مستلم الطلب  </h3></td></tr>
                                            <tr>
                                            <td>
                                                <div class="basic_detail">
                                                    <div>
                                                            <span class="mb-2" > اسم المستلم </span>
                                                            <h5> {{$userInfo->receiverName}}</h5>
                                                        </div>
                                                        <div>
                                                            <span>  تليفون المستلم </span> 
                                                            <h5>{{$userInfo->receiverPhone}}</h5>
                                                         </div>
                                                </div>
                                                <!-- basic_detail -->
                                            </td>
                                            <!-- design Details -->
                                           
                                            <td>
                                                <div class="basic_detail">
                                                    <div>
                                                            <span> البلد  </span>
                                                            <h5> {{$userInfo->country}}</h5>
                                                        </div>
                                                        <div>
                                                            <span>  المحافظة  </span> 
                                                            <h5>{{$userInfo->city}}</h5>
                                                         </div>
                                                        
                                                </div>
                                                <!-- basic_detail -->
                                            </td>
                                            <td>
                                                <div class="design_detail_bigger">
                                                        <div>
                                                            <span class="font-color">  المدينة  </span> 
                                                            <h5 class="border py-2 px-2">{{$userInfo->town}}</h5>
                                                         </div>
                                                        <div class="advice-content "> 
                                                        <span>  العنوان </span>                                            
                                                        <div class="contents"> {{$userInfo->address}}  </div>
                                                        </div>
                                                </div>
                                                <!-- basic info -->
                                            </td>
                                            <!--  end design details -->
                                            </tr>
               
                                    </tbody>
                                </table>
      
            </div>
        <!-- col-md-12 -->
            
        </div>
        <!-- row -->
    </div>
        <!-- container main one -->
</div>
<!-- all_items -->

@endsection