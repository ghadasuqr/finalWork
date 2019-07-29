@extends('frontend.layout.app')
@section('content')


<div class="container">
    <div class="row">
    <div class="shopping-cart-header main-bg">
                <i class="fa fa-shopping-cart fa-2x " ></i>  
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row ">
                        <div class="col-md-6">
                            <h5 class="sectionTitle  text-right px-5" > شركة مسك  لملابس المحجبات</h5>
                     
                        </div>

                        <div class="col-md-6 text-center px-5 pt-3">
                            <p class="font-weight-bold mb-1">فاتورة رقم  #550</p>
                            <p class="text-muted">بتاريخ: {{ Date('Y-m-d') }}</p>
                        </div>
                    </div>

                    <hr class="my-2 color-font">
<!-- ================================================================== -->
                    <div class="row   p-3">
                        <div class="col-md-6 text-right px-5">
                            <p class="font-weight-bold mb-4"> <span class=" border-bottom py-3"> تفاصيل   الشحن  </span> </p>
                            <p class="mb-1">{{ $user_shipping_info->city}}</p>
                            <p>Acme Inc</p>
                            <p class="mb-1">Berlin, Germany</p>
                            <p class="mb-1">6781 45P</p>
                        </div>

                        <div class="col-md-6  px-5 text-center px-5 ">
                            <p class="font-weight-bold mb-4 "> <span class=" border-bottom py-3"> تفاصيل  الفاتورة </span> </p>
                            <p class="mb-1"><span class="text-muted ">طريقة الدفع: </span> كاش</p>
                            <p class="mb-1"><span class="text-muted">الاسم: </span> غادة صقر  </p>
                        </div>
                    </div>
<!-- ============================================================================================================================================ -->
<!-- ======================================================================================================================================================= -->
                    <div class="row px-5 pt-2">
                        <div class="col-md-12">
                            <table class="table">
                                <thead class="border-top-bottom">
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">الرقم</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الموديل</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الاسم</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الكمية</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">السعر للوحدة  </th>
                                        <th class="border-0 text-uppercase small font-weight-bold">التخفيض للوحدة  </th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الاجمالى </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Software</td>
                                        <td>LTS Versions</td>
                                        <td>21</td>
                                        <td>$321</td>
                                        <td>$321</td>
                                        <td>$3452</td>
                                    </tr>
           
                                </tbody>
                            </table>
                        </div>
                    </div>
<!-- ===================================================================================== -->
                    <div class="d-flex flex-row-reverse bg-dark text-white p-4 mb-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">$234,234</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Discount</div>
                            <div class="h2 font-weight-light">10%</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub - Total amount</div>
                            <div class="h2 font-weight-light">$32,432</div>
                        </div>
                    </div>
                </div>         <!-- card body-->
         
            </div>   <!-- card -->  

        </div>      <!-- col-12 -->
    </div>          <!-- row -->

</div>     <!-- container -->   


@endsection