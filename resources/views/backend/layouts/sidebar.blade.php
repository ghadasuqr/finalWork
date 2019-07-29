<div  class=" fixed-menu pb-5">
        <div class="fixed-menu-header">
            <h3 class=" fixed-r-b-border"> لوحة التحكم  </h3>
         </div>
        <ul class="nav flex-column text-right">
            
            <li class="nav-item dropdown">
                <a class="nav-link  "  id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> التعليقات</a>
                <ul   class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                    <li class="nav-item"><a class="dropdown-item nav-link"  href="{{url('dashboard/comments')}}">التعليقات</a></li>
                </ul>
            </li>
            <!--  -->
            
            <li class="nav-item dropdown">
                <a class="nav-link  "  id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> المستخدمين</a>
                <ul   class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                    <li class="nav-item"><a class="dropdown-item nav-link"  href="{{url('dashboard/getUsers')}}">مفعل</a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/blockedUsers')}}">محجوب </a></li>
                </ul>
            </li>
      
            <li class="nav-item dropdown">
                <a class="nav-link  "  id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> اوامر </a>
                <ul   class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/orders')}}">قائمة</a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/orders/new')}}"> جديد</a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/orders/pending')}}"> تجهيز</a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/orders/completed')}}"> مكتمل</a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/orders/paid')}}">   مدفوع </a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/orders/returned')}}">  راجع </a></li>

                </ul>
            </li>
            <!--  -->
            <li class="nav-item dropdown">
                <a class="nav-link  "  id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> الاقسام</a>
                <ul   class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('category')}}">قائمة</a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('category/create')}}">قسم جديد</a></li>
                </ul>
            </li>
            <!--  -->
            <!--  -->
            <li class="nav-item dropdown">
                <a class="nav-link  "  id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> الموديلات</a>
                <ul   class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/models')}}">قائمة</a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/models/create' )}}">موديل جديد</a></li>
                </ul>
            </li>
            <!--  -->
            <!--  -->
            <li class="nav-item dropdown">
                <a class="nav-link  "  id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> الملابس</a>
                <ul   class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/items')}}">قائمة</a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/hiddenItems')}}"> مخفية </a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/items/create')}}">منتج جديد</a></li>
                </ul>
            </li>
            <!--  -->
            <!--  -->
            <li class="nav-item dropdown">
                <a class="nav-link  "  id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> السلايدر</a>
                <ul   class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/slides')}}">قائمة</a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/slides/create')}}">سلايدر جديد</a></li>
                </ul>
            </li>
            <!--  -->
            <!--  -->
            <li class="nav-item dropdown">
                <a class="nav-link  "  id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">تحفيضات</a>
                <ul   class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{ url('dashboard/sales')}}">قائمة</a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{ url('dashboard/sales/create')}}">تخفيض جديد</a></li>
                </ul>
            </li>
            <!--  -->
            <li class="nav-item dropdown">
                <a class="nav-link  "  id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> الأسئلة والأجوبة</a>
                <ul   class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/fq')}}">قائمة </a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/fq/create')}}">إنشاء جديد</a></li>
                </ul>
            </li>
            <!--  -->
            <!--  -->
            <li class="nav-item dropdown">
                <a class="nav-link  "  id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">  متغيرات الموقع</a>
                <ul   class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/settings/listURL')}}"> روابط السوشيال </a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/settings/connect')}}"> معلومات  الاتصال </a></li>
                    <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('dashboard/settings/saleName')}}"> اسماء التخفيضات </a></li>
                </ul>
            </li>
            <!--  -->

           
        </ul>

</div>


