@extends('backend.layouts.app')
@section('content')
<!-- ============================================================================================================================================= -->

<div class="container  my-5">
<div class="row">
<div class="col-12">
            <div class="card">
                <div class="card-body p-0">
<!--------------------------------------------------------->
@if(count($items)==0)
<div  class="text-right py-5 my-5"><h5 class="sectionTitle py-5  my-4 border "  >عفوا لا  يوجد منتجات    </h5></div>  
@else
<!-- ----------------------------------------------------------- -->

<div  class="text-right"><h5 class="sectionTitle  " > الاحدث </h5>  <span   class="sectionTitle  pr-5">  العدد ( {{ count($items) }})  </span> </div>  
<div class="login px-5 mt-3 ">
    {!! Form::Open(['class'=>'form-group border box-shadow login'  , 'method' =>'GET'])!!}
    <input  class="form-control mb-2" type="text" name="q" placeholder="البحث     عن الموديل او الاسم أو القماش 1  "  value="@if(isset($_GET['q'])){{$_GET['q']}}@endif"> 
    {!! Form::Close() !!}
</div>       
<div class="row px-5 pt-2 ">
                        <div class="col-md-12">
                            <table class="table">

                                <thead class="border-top-bottom ">

                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">مسلسل</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الكود</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الصورة</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الموديل</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الاسم</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الكمية</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">القماش1</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">السعر للوحدة  </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $key => $item) 
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->code}}</td>
                                        <td><img  style="width:60px ; height:60px" src="{{ url( App\Itemimage::getImagesForItem($item->code)[0] )  }}" alt="" /></td>
                                    <td> {{  App\Imodel::getModeNamelById(  App\Item::getModelNo($item->code) )  }}</td> 
                                    <td>{{ App\Item::getItemName($item->code)}}</td>  
                                    <td>{{$item->quantity }}</td>                     
                                    <td>{{$item->materialType1 }}</td>
                                    <td>{{$item->price }}</td>

                                    </tr>
                                    @endforeach
           
                                </tbody>
                            </table>
                        </div>
                    </div>
   <!-- =================================== -->
   @endif
<!-- ----------------------------------------------- -->
                </div>         <!-- card body-->
         
            </div>   <!-- card -->  

        </div>      <!-- col-12 -->
     
     </div>          <!-- row -->

<!-- pagination -->
<div style=" display:flex ; justify-content:center ;width:100%">
                <div class="col-md-4 text-center  " style=" display:flex ; justify-content:center;width:100%">
         
                {!! $items->links() !!}
       
                </div>
        </div>
    <!-- pagination -->
</div>     <!-- container -->  
 <!--============================================================== End Most Sold=================================================================================  -->

@endsection