@extends('frontend.layout.app')
@section('content')
<div class="container"> 
        <!-- row -->
        <div class="row">
            <div class="col-sm-12">
      
<!-- accordion -->
        <div class="accordion box-shadow text-right">
                <!-- header -->
                <div class="accordion-title pt-3 main-bg">  
                        <h3 class=" text-shadow responsive "> الاسئلة الشائعة   </h3> 
                        <i class="fa fa-question-circle-o   fa-flip-horizontal mr-3 text-shadow " ></i> 
                </div> 
                <!-- header -->
                @if( count($fqs) >0)
                @foreach($fqs as $key =>$fq)
                <!-- q &answer -->
                <div class="accordion-header">
                        <i class="fa fa-chevron-down"></i> 
                        {{$fq->question}}  
                </div>
                <div class="accordion-content">
                    <p>  {{$fq->answer}}</p>
                </div>
                <!-- q &answer -->
        @endforeach
                @endif
        </div>
<!-- accordion -->
         </div>
         <!-- col-12 -->
    </div>
    <!-- row -->

</div> 
<!-- container -->


@endsection