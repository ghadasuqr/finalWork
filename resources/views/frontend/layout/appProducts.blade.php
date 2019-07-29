@include ("frontend.layout.header")
<script type="text/javascript" src="{{url('frontend/assets/js/jquery-3.3.1.min.js')}}"></script>

<script type="text/javascript" src="{{url('frontend/assets/js/listGrid.js')}}"></script>

<div class="container">

    <div class="row">
            <div class="buttons ">
                    <button class="btn active" tooltop="grid" id="grid">شبكة<i  class="fa fa-th"></i></button>
                    <button   class="btn" id="list" > قائمة<i class="fa fa-list"></i></button>
            </div>
    </div>

</div>
<!-- list grid buttons// must be separate -->
<div class="container products">
    <div class="row text-right">
@include ("frontend.layout.sidebar")


@yield('content')
@include ("frontend.layout.footer")
<!--code for  add to wish list  -->
@include('frontend.layout.jscode')
<!--code for  add to wish list  -->
@yield('jscode')


</body>
</html>