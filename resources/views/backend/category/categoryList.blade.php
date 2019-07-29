
@extends('backend.layouts.app')

@section('content')

<!-- <div class="page"> -->
    <div class="container">
        <div class="row">
            
             <div class="col-md-12 col-sm-12">
                 <div class="shopping-cart-header main-bg text-center">
                   <h3 class="text-center">    الفئـات  </h3>
                   <i class="fa fa-tag fa-2x"></i>
                </div>
@if(count($data)==0)
<div  class="text-right"><h5 class="sectionTitle  " >لا يوجد نتايج    </h5></div>  
@else          
                <div class="cart">

                    <div class=" container shopping-cart">                            
                                             
                        <div class="shopping-cart-table"> 
                                    <!-- <div class="table-responsive"> -->
                                          <table class="table table-responsive box-shadow px-5 pb-5" style="border-top:3px solid pink;">
                                            <tr>
                                                    <td class="text-right"> 
                                                    <a href="{{url('category/create')}}" class="btn get" > أضافة فئة  جديدة </a> </td>
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
                                              <h5 class="sectionTitle">  العدد  ( {{ count($data)}} )</h5> 
                                              </td>
                                            </tr>
                                            <tr class="main-bg">
                                        
                                                    <th   class="title text-right"  scope="col" width="20" >الرقم</th>
                                                    <th  class="title text-right"   scope="col" width="300">الاسم</th>
                                                 
                                                    <th  class="title text-right"  scope="col" width="200" class="mr-2">اخفاء</th>
                                                    <th  class="title text-right"  scope="col" width="200" class="mr-2">اعادة</th>
                                                    <th  class="title text-right"  scope="col" width="200">تعديل</th>

                                            </tr>
                                  
                                            @foreach($data as $key => $row)




                                            <tr @if($row->active == 1) class="backg-not-active" @endif>
 
                                                    <td>{{ $key+1}}</td>
                                                    <td>{{ $row->categoryName}}</td>
                                                    <!-- <form   method="post" action="{{ URL:: to('categories/destroy/'.$row->categoryNo) }}" > -->
                                                    <!-- @csrf -->
                                                    <!-- {{ Form::open(array('url' => 'category/destroy')) }} -->
                                                    {!! Form::Open(['url'=>'category/destroy/'.$row->categoryNo]) !!}

                                                    <td class="text-right"> 
                                                    <a href="{{ url('category/destroy/'.$row->categoryNo) }}" class="btn btn-outline-danger"> × اخفاء</a>
                                                    </td>
                                                    {!! Form::Close() !!}
                                                    
                                                    {!! Form::Open(['url'=>'category/show/'.$row->categoryNo]) !!}

                                                    <td class="text-right"> 
                                                    <a href="{{ url('category/show/'.$row->categoryNo) }}" class="btn btn-outline-danger"> × اعادة</a>
                                                    </td>
                                                    {!! Form::Close() !!}
                                                   
                                                    <td class="text-right"> 
                                                    <a href="{{ url('category/edit/'.$row->categoryNo)}}" class="btn btn-outline-warning"> تعديل</a>
                                                    </td>
                                                    <!-- {{ Form::close() }} -->

                                            </tr>
                                                <!-- </form> -->
                                
                                        @endforeach
                                        </table>
                                    <!-- </div>        -->
                            
                        </div> 
                        <!--shopping cart table  -->
                                         
                    </div>  <!-- container -->

                 </div>    <!--   cart -->
             </div>
        </div>
@endif       
    </div>
<!-- </div> -->
<!--  -->
@endsection