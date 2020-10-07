<header>

    <div class="header-area header-transparent">
        <div class="main-header ">
            <div class="header-top d-none d-lg-block">
                <div class="container-fluid">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="header-info-left">
                                <ul>
                                    <li>{{$config->phone}}</li>
                                    <li><a href="" style="color: #FFFFFF">{{$config->email}}</a></li>
                                    <li>Baz-Şənbə 8:00 - 18:00, Bazar - Bağlı</li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                                <ul class="header-social">
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">

                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">

                                <a href="{{route('home')}}" class="big-logo"><img style="height: 85px"
                                                                         src="{{asset('uploads/photo/').'/'.$config->logo}}"
                                                                         alt=""></a>
                                <a href="{{route('home')}}" class="small-logo"><img style="height: 60px"
                                                                           src="{{asset('uploads/photo/').'/'.$config->logo}}"
                                                                           alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8">

                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="{{route('home')}}">{{trans('sozler.home')}}</a></li>
                                        <li><a href="{{route('about')}}">Haqqımizda</a></li>
                                        <li><a href="project.html">İşlərimiz</a></li>
                                        <li><a href="">Xidmətlərimiz</a>
                                            <ul class="submenu">
                                                @foreach($services as $servis)
                                                    <li><a href="{{route('servisDetail',$servis->slug)}}">{{$servis->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>

                                        <li><a href="contact.html">Əlaqə</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                <a href="#" class="btn">Bizimlə Əlaqə</a>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
