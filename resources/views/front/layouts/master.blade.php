

<!doctype >
<html class="no-js" lang="zxx">

<meta http-equiv="content-type" content="text/;charset=UTF-8"/>
<head>

    @include('front.layouts.include.head')
</head>
<body>

<!--<div id="preloader-active">-->
<!--<div class="preloader d-flex align-items-center justify-content-center">-->
<!--<div class="preloader-inner position-relative">-->
<!--<div class="preloader-circle"></div>-->
<!--<div class="preloader-img pere-text">-->
<!--<img src="/front/assets/img/logo/loder-logo.png" alt="">-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->

@include('front.layouts.include.header')
<main>

    @yield('slider')


    @yield('content')





    @include('front.layouts.include.footer')

    @include('front.layouts.include.foot')
</main>
</body>

</body>
</html>
