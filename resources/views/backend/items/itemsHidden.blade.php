
@extends('backend.layouts.app')
@section('content')

<div class="all_items">
        <div class="container">
            
            <div class="row">  
                        <div class="col-md-12 col-sm-12">

                                <div class="shopping-cart-header main-bg">
                                <h3 class="title">    المنتجات   المخفية </h3>
                                </div>

<!--============================================================-->
@if(count($items)==0)
<div  class="text-right py-5 my-5"><h5 class="sectionTitle  py-5 my-4 " >لا يوجد نتايج    </h5></div>  
@else     
<!-- ====================================================== -->                      
                                <div class=" cart">

                                    <div class="  shopping-cart ">                            
                                                                
                                        <div class="shopping-cart-table" > 
                                            <!-- <div class="table-responsive"> -->
                                                        <table class="table  table-responsive table-bordered">

                                                        <!--  -->
                                                        <tr><td colspan="4">

                                                        <div class="login">
                                                                {!! Form::Open(['class'=>'form-group  box-shadow login'  , 'method' =>'GET'])!!}
                                                                <input  class="form-control mb-2" type="text" name="q" placeholder="البحث  "  value="@if(isset($_GET['q'])){{$_GET['q']}}@endif"> 
                                                                {!! Form::Close() !!}
                                                            </div>
                                                        </td></tr>
                                                        <!--  -->
                                                            <tr>                                                                   
                                                                 <td > <a href="{{url('dashboard/items/create')}}" class="btn get px-5" >  منتج جديد</a> </td>
                                                                 <td colspan="2" class="text-center">
                                                                    <h5 class="sectionTitle">                                                         
                                                                        @if(Session::has('success'))                     
                                                                            {{   Session::get('success')}}
                                                                            @else
                                                                            {{ Session::get('error')}}
                                                                        @endif                                                         
                                                                    </h5>
                                                                </td>
                                                                 <td><h5 class="sectionTitle">  العدد  ({{ count ($items)}})</h5> </td>
                                                            </tr>
                                                            <tr class="main-bg">
                                                                    <th class="title"   scope="col">الصورة</th>
                                                                    <th class="title" scope="col">المعلومات الاساسية </th>
                                                                    <th  class="title" scope="col"> الالوان</th>
                                                                    <th  class="title" scope="col">تفاصيل التصميم  </th>

                                                            </tr>
                                                                     <!-- start of while  -->
                                                          
                                                   @foreach($items as $key => $item)
                                                   <tr @if($item->active == 1) class="backg-not-active" @endif>

                                                  
                                                                    <td>  رقم ( {{ $key +1}} ) <br><br>


                                                                        <img  width="100px" height="150px" src="{{url (  App\Itemimage::getImagesForItem($item->code)[0]   ) }}" alt="" />
                                                      
                                                                    </td>
                                                                    <td>
                                                                        <div class="basic_detail">
                                                                            <div><h5>{{ $item->itemDescription}}</h5></div>
                                                                            <div class="info-content">
                                                                                <div class="info">الفئة  </div>
                                                                                <?php
                                                                                    $categoryNo=App\Imodel::catNoByModelNo($item->modelNo);  
                                                                                ?>
                                                                                <div class="content">  {{ App\category::getNameCatById($categoryNo)  }}</div>
                                                                            </div>
                                                                            <div class="info-content">
                                                                                <div class="info">الموديل </div>
                                                                                <div class="content">{{App\Imodel::getModeNamelById($item->modelNo) }} </div>
                                                                            </div>
                                                                            <div class="info-content">
                                                                                <div class="info">السعر  </div>
                                                                                <div class="content"> {{ $item->price }} &nbsp; &nbsp;&nbsp; ج </div>
                                                                            </div>
                                                                            <div class="info-content">
                                                                                <div class="info">الكمية  </div>
                                                                                <div class="content"> {{ $item->quantity }}  </div>
                                                                            </div> 
                                                                            <div class="info-content">
                                                                                <div class="info">التاريخ </div>
                                                                                <div class="content"> {{App\Sale::rightDate($item->created_at) }}  </div>
                                                                            </div>                                                                     
                                                                            
                                                                        </div>
                                                                    </td>
                                                                    <!-- colors -->
                                                                    <td>
                                                                        <div class="m_size">
                                                                        @foreach(App\Color::getItemColors($item->code) as $key => $color)
                                                                    
                                                                            <h5 class="infoTitle"> {{ $color->color }} </h5>                                                                                   
                                                                                <ul >
                                                                                    <!-- //size -->                                                                                
                                                                                        @foreach(App\Size::getSizesforColor($color->id) as $key => $size)

                                                                                        <li><span class="size">{{ $size->size}}</span><br><span class="count">{{  $size->count}}</span></li>
                                                                                        @endforeach
                                                                                    <!-- //size -->
                                                                                </ul>
                                                                         @endforeach   
                                                                        <!-- color -->
                                                                            <!-- //details  -->
                                                                        </div>
                                                                    </td> 
                                                                    <!--color -->
                                                                    <!-- design Details -->
                                                                    <td>
                                                                        <div class="design_detail">
                                                                            <div class="info-content">
                                                                                <div class="type">{{ $item->materialType1 }}  </div>
                                                                                <div class="t-value">{{ $item->materialRatio1}} &nbsp;&nbsp;&nbsp;% </div>
                                                                            </div>
                                                                            <div class="info-content">
                                                                            <div class="type">{{ $item->materialType2 }}  </div>
                                                                                <div class="t-value">{{ $item->materialRatio2}} &nbsp;&nbsp;&nbsp;% </div>
                                                                            </div>
                                                                            <div class="info-content">
                                                                                <div class="type">الغسل   </div>
                                                                                <div class="t-value">{{ $item->wash }} </div>
                                                                            </div>
                                                                            <div class="advice-content ">
                                                                                <span >نصيحة المصمم   </span>
                                                                                <div class="advice"> 
                                                                                     <p >{{ $item->advice }} </p>                                                      </div>
                                                                        
                                                                                </div>

                                                                        </div>
                                                                        <!-- basic info -->
                                                                    </td>
                                                                
                                                                    <!--  end design details -->
                                                            </tr>
                                                            <tr style="border-bottom:2px solid #aaa">
                                                                <td  colspan="4" class="text-center"> 
                                                                <div style="display:flex; flex-flow:row ;justify-content:space-between" width="100%" class="px-3">

                                                                    {!! Form::Open(['url' => 'dashboard/items/show/'.$item->code  ]) !!}                                                             
                                                                      <button  class="btn btn-outline-danger px-5 " > اعادة </button>
                                                                    {!! Form::Close()   !!}
                                                                       
                                                                </div>
                                                                </td>                                               

                                                            </tr>
                                                        @endforeach
                                                     
                                                        </table>
                                                    <!-- </div>      -->
                                                <!-- table responsive -->
                                        </div> 
                                        <!--shopping cart table  -->
                                                        
                                    </div>  <!-- container shopping cart -->
                                </div>  
                                <!--   cart -->
                            <!-- </div> -->
                         </div>
                <!-- col-md-12 -->


            </div>

            <!-- row -->
      <!-- pagination -->
        <div style=" display:flex ; justify-content:center ;width:100%">
                <div class="col-md-4 text-center  " style=" display:flex ; justify-content:center;width:100%">
                    {!! $items->links() !!}
                </div>
        </div>
    <!-- pagination -->
<!-- ============================ -->
@endif 
<!-- ============================           -->
        </div>
        <!-- container main one -->
</div>
<!-- all_items -->


@endsection()