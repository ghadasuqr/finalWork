
<!-- =========================================================== Most Sold ==================================================================== -->
<?php
$data= App\Http\Controllers\backend\appBackCtrl::mostRatedToAdmin();

?> 	
<!-- ============================================================================================================================================= -->

<div class="container  my-5">
<div class="row">
<div class="col-12">
            <div class="card">
                <div class="card-body p-0">
@if(count($data)==0)
<div  class="text-right"><h5 class="sectionTitle  " >لا يوجد منتجات  </h5></div>  
@else
<div  class="text-right"><h5 class="sectionTitle  " > الاكثر تقييما</h5></div>  
          
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
                                        <th class="border-0 text-uppercase small font-weight-bold">المعدل</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">السعر للوحدة  </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $item) 
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->code}}</td>
                                        <td><img  style="width:60px ; height:60px" src="{{ url( App\Itemimage::getImagesForItem($item->code)[0] )  }}" alt="" /></td>
                                    <td> {{  App\Imodel::getModeNamelById(  App\Item::getModelNo($item->code) )  }}</td> 
                                    <td>{{ App\Item::getItemName($item->code)}}</td>  
                                    <td>{{$item->average *20}} %</td>                     
                                    <td>{{App\Cart::getItemPrice($item->code) }}</td>

                                    </tr>
                                    @endforeach
           
                                </tbody>
                            </table>
                        </div>
                    </div>
   <!-- =================================== -->
   @endif

                </div>         <!-- card body-->
         
            </div>   <!-- card -->  

        </div>      <!-- col-12 -->
     
     </div>          <!-- row -->
 <!-- more -->
 <div style=" display:flex ; flex-direction:row-reverse ;width:100%">
           <a href="{{url('dashboard/mostRatedAdminPage')}}" class="get btn  ">المزيد</a>
        </div>
    <!-- more -->
</div>     <!-- container -->  
 <!--============================================================== End Most Sold=================================================================================  -->

