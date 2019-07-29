@extends('backend.layouts.app')

@section('content')

<div class="all_items">
    <div class="  container  " id="height" >
        <div class="row">            
            <div class="col-md-12 col-sm-12">
                <div class="shopping-cart-header main-bg">
                    <h3 class="title">   قائمة  السلايدر  </h3>
                    <i class="fa fa-picture-o fa-2x" style="color:#fff"></i>
                </div>
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->
@if(count($slider)==0)
                <div  class="text-right py-5 my-5"><h5 class="sectionTitle py-5 border "  >عفوا لا  يوجد نتايج    </h5></div>  
@else          
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

                <div class=" cart">

                    <div class="  shopping-cart ">
                        <div class="shopping-cart-table" > 
                            <!-- <div class="table-responsive"> -->
                                <table class="table  table-responsive table-bordered  box-shadow py-5 px-5 my-5 ">
                                <tr>
                                              <td colspan="5">
                                                <div class="login">
                                                  {!! Form::Open(['class'=>'form-group  box-shadow login'  , 'method' =>'GET'])!!}
                                                  <input  class="form-control mb-2" type="text" name="q" placeholder="البحث  عن كلمة فى اى عنوان او المحتوى "  value="@if(isset($_GET['q'])){{$_GET['q']}}@endif"> 
                                                  {!! Form::Close() !!}
                                                </div>
                                              </td>
                                              
                                            </tr>
                                                                              
                                    <!-- <thead style="width:100%"> -->
                                    <tr>                                                                    
                                            <td > <a href="{{url('dashboard/slides/create')}}" class="btn get px-2" >   سلايدر جديد</a> </td>
                                            <td colspan="2" class="text-center">
                                                    <h5 class="sectionTitle">                                                        
                                                        @if(Session::has('success'))
                                                        {{   Session::get('success')}}
                                                        @elseif(Session::has('error'))
                                                        {{     Session::get('error')}}
                                                        @endif
                                                    </h5>
                                              </td>
                                              <td>
                                                    <h5 class="sectionTitle">  العدد  ( {{ count($slider)}} )</h5> 
                                              </td>
                                    </tr>
                          
                                    <tr class="main-bg">
                                        <th class="title"   scope="col">الصورة</th>
                                        <th class="title" scope="col">   العناوين الاساسية</th>
                                        <th  class="title" scope="col"> مهام</th>
                                        <th  class="title" scope="col"> المحتوى  </th>

                                    </tr>
                                    <!-- </thead> -->
                            
                                    
                                    <tbody style="width:100%">
                                    @foreach($slider as $key => $row)
                                            <tr>

                                            <td>
                                                <label for="img">{{$key+1}}</label><br>

                                                <img   style="width:100px ; height:150px"  src=" {{ url( App\Itemimage::getImagesForItem($row->itemCode) [0]) }}" alt="" />
                                                
                                            </td>
                                            <td>
                                                <div class="basic_detail">
                                                    <div>
                                                        <span>العنوان  الرئيسي</span>
                                                        <h5> {{$row->title1}}</h5></div>
                                                    <div>
                                                        <span>  العنوان الفرعي</span> 
                                                         <h5>{{$row->title2}}</h5></div>
                                                    </div>
                                                <!-- basic_detail -->
                                            </td>

                                            <!-- design Details -->

                                            <td>
                                            <div class="design_detail_smaller">
                                                <div class="info-content mb-3">
                                                    <div class="type-half">مفعل </div>
                                                        <div class="t-value-half">{{$row->active}}  </div>
                                                </div>
                                                <div class="info-content">
                                                    <div class="type-half">ترتيب </div>
                                                        <div class="t-value-half">   {{$row->sort}} </div>
                                                </div>
                                                </div>
                                            </td> 

                                            <td>
                                                <div class="design_detail_bigger">
                                                    <div class="advice-content "> 
                                                    <span>   المحتوى</span>                                            
                                                        <div class="contents"> {{$row->content}}  </div>
                                                </div>
                                                <!-- basic info -->
                                            </td>

                                            <!--  end design details -->
                                            </tr>
                                            <tr style="border-bottom:2px solid #aaa">
                                                <td  colspan="4" class="text-center"> 
                                                    {!!  Form::Open([  'url'=>'dashboard/slides/destroy/'.$row->sliderNo ]) !!}                                                             
                                                    <button class="btn btn-outline-danger px-5" > × حذف</button>
                                                    
                                                    <a  href="{{  url('dashboard/slides/edit/'.$row->sliderNo)  }}" class="btn btn-outline-warning  px-5"> تعديل</a>


                                                    {!! Form::Close() !!}
                                                </td>                                               

                                            </tr>
                                            @endforeach
                                    
                                    </tbody>

                            
                            
                                        <!-- end of while  -->
                                
                                </table>
                                    <!-- </div>      -->
                                <!-- table responsive -->
                        </div> 
                        <!--shopping cart table  -->
                                        
                    </div>  <!-- container shopping cart -->
                </div>  
                <!--   cart -->
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->
@endif
<!-------------------------------------------------------------------------------------------------------------------------------  if data found  -->

            </div>
        <!-- col-md-12 -->

            </div>
        <!-- row -->

    </div>
        <!-- container main one -->
</div>
<!-- all_items -->

@endsection