@extends('frontend.layout.app');
@section('content')

<!--=========================================================================================================-->
	
<div class="container ">
@if(count($data)==0)
<div  class="text-right my-5 py-5"><h5 class="sectionTitle py-5 border " >لا يوجد منتجات فى  تفضيلاتك </h5></div>  
@else

<div class="row">
<!-- --------------------------------- if data found -->

<!-- --------------------------------- if data found -->

<div class="shopping-cart-header main-bg">
                        <h3> تفضيلاتك&nbsp; &nbsp;{{ Auth::User()->name}}   </h3>

                     <i class="fa fa-heart fa-2x " ></i>  
                </div>
                <!--  -->

                <!--  -->
                    
              <div class="shopping-cart-table  " style="display:flex;justify-content:center" >        
                <table class="table table-responsive box-shadow text-center" style="padding:40px 120px">
                    <!--  messages -->

                        <tr>
                            <td colspan="5" class="text-center ">
                            <div class=" py-3">
                            <h5 class="sectionTitle">  

                            @if(Session::has('success'))
                                {{Session::get('success')}}
                            @elseif( Session::has('error') )
                                 {{Session::get('error')}}
                            @endif
                            </h5>
                            </div>

                            </td>
                        
                        </tr>

                      <!--  messages -->

                       
                            <thead >
                                <tr >
                                    <th scope="col">  الرقم  </th>
                                    <th scope="col" class="text-right pr-4"> تفاصيل المنتج  </th>
                                    <th scope="col">  السعر  </th>                            
                                    <th scope="col" width="120">تاريخ الاضافة </th>
                                    <th scope="col" class="text-center" width="200">حـذف</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <!-- data= favorite table  foe certain  authorized user  -->
                                @foreach($data as $key => $row) 
                                <!-- for each code in resulted collection give item info   -->
                                @foreach(App\Item::where('code' , $row->code)->get() as $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <div  class="item-right">
                                                <div  class="item-img">
                                                    <img  style="width:100px ; height:100px" src="{{  App\Itemimage::getImagesForItem($item->code)[0]   }}" alt="" />
                                                </div>
                                                <div class="item-info">     
                                                    <ul >                                                             
                                                        
                                                            <li> <span class=" titl pl-5 font-color"  >الاسم</span ><span class="info">  {{ $item->itemDescription}} </span></li>
                                                            <li> <span class=" titl pl-5 font-color"  >الموديل</span ><span class="info"> {{ App\Imodel::getModeNamelById($item->modelNo)  }}  </span></li>

                                                           
                                                    </ul>
                                                </div>
                                            </div>
                                    </td>

                                    <td class="not"> {{$item->price}}<span class="font-color"> ج</span>   </td>
                                   <td class="text-right"> 
                                            <span>{{App\Sale::rightDate($row->created_at)}}</span> </td>
                             
                                    <td class="text-center"> 
                                    <a href="{{url('wishList/'.$row->code)}}" class="btn get px-3"> × حذف</a>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                <!-- end item info -->
                               @endforeach
                               <!--  end collection for certain user  -->
                            
                            </tbody>
                </table>
              </div>  
                    <!--shopping  -->
                         

            <!-- </div> -->


    </div>
    <!-- row -->
<!-- --------------------------------- if data found -->

@endif
<!-- --------------------------------- if data found -->
</div> 
<!-- container -->
 <!--===========================================================================================================================-->
 @endsection