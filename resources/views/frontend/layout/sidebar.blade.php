        <!-- sidebar col-3 -->
        <div class=" sidebarR col-sm-3 col-md-3">
                <div  class="sidebar border">
                        <div class=" main-bg ">
                        <h3 class=" ">الاقسام الرئيسية </h3>
                         </div>
                        <ul class="nav flex-column text-right">
                            @foreach(App\category::getCats() as $category)
                            <li class="nav-item dropdown">
                                <a class="nav-link  " style="padding:0 0" id= "drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> {{ $category->categoryName}}</a>
                                 @if(count(App\Imodel::getmodelsByCatId($category->categoryNo))>0))
                                    <ul  style="margin:0" class="dropdown-menu  flex-column text-right" aria-labelledby="drop">
                                        @foreach(App\Imodel::getmodelsByCatId($category->categoryNo) as $model )
                                           <li class="nav-item"><a class="dropdown-item nav-link" href="{{url('products/'.$model->modelNo)}}">{{$model->modelName}}</a></li>
                                        @endforeach
                                     </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>

                </div>

                <div class="sidebar ">
                    <div><p > اختر المقاس ثم  اللون ثم السعر ثم اضغط تصفية </p></div>
                </div>
                
                {!! Form::Open(['url'=>'products/search' , 'method' =>'GET']) !!}

                 <div  class="sidebar border">              

                    
                     <div class=" main-bg ">
                             <h3 class=" ">  اختر المقاس    </h3>
                         </div>
                     
                    <ul class="nav flex-column text-right">
                        <?php  $sizes=array("XXL" ,"XL" , "L"  , "M"  ,"S" ); $rsize=""; ?>
                            @foreach($sizes as $size)
                                <li class="nav-item">
                                    <label class="radio">
                                    <input type="radio" value="{{$size}}"
                                     name="size"   checked=" @if ($rsize)  == $size) checked @else ''  @endif "     >
                                     &nbsp;&nbsp;{{$size}}</label>
                                </li>
                            @endforeach
                    </ul>
                 </div>
                 <div  class="sidebar border">
                        <div class=" main-bg ">
                             <h3 class=" "> مدى السعر    </h3>
                         </div>
                         <ul class="nav nav-number">
                         <li><span class="font-color ml-2"> من</span><input  class="num-input" type="number" name="min"   value="  @if (isset($_GET['min'])) {{ $_GET['min']}} @endif  "   id="min" min="10" max="5000" step="10" placeholder="من"></li>
                         <li><span class="font-color mxl-2">الى <input class="num-input" type="number" name="max"   value="  @if (isset($_GET['max'])) {{ $_GET['max']}} @endif  "  id="min" min="100" max="5000" step ="100"placeholder="الى"></li>

                </div> 
                 <div  class="sidebar border">
                        <div class=" main-bg ">
                        <h3 class=" "> اختر اللون   </h3>
                         </div>
                        <ul class="nav flex-column text-right">
                            <?php   $colors=array("أبيض" ,"أسود" , "أحمر"  , "رصاصي"  ,"أزرق" , "بني" , "أخضر" , "بيج");?>
                                @foreach($colors as $color)
                                   <li class="nav-item">
                                        <label class="radio"><input type="radio" value="{{$color}}" name="color">&nbsp;&nbsp;{{$color}}</label>
                                        </li>
                                  @endforeach
                                
                        </ul>
                </div> 
                <div class="sidebar text-center border">
                <input class="btn get px-5 mb-4" type="submit" name="filter" value="تصفية">

                </div>  
             {!! Form::Close()!!} 
        </div>
        <!-- sidebar col-3 -->