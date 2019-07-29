                            {{ $sale->startDate}}
                            <br>
                                <?php 
                                    $startDate= explode(' ',$sale->startDate)[0] ;
                                    $startDate=str_replace('-','/', $sale->startDate);                  
                                    $startDate=date("m-d-Y", strtotime($startDate));
                                ?>
                            {{  $startDate  }}
                            <br>


                            <!-- ============================  -->

        <input  class="form-control mb-2" type="date" value="{{$startDate}}" name="startDate"  />
