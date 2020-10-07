<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="{{route('admin')}}" class="media-left">
                        <img src="/back/assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                    </a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">{{auth()->guard('admin')->user()->fullname}}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <li><a href="{{route('admin')}}"><i class="fa fa-home"></i> <span>'    '</span></a></li>
                    {{--                    <li><a href="{{route('admin.post')}}"><i class="icon-magazine"></i> <span>Xəbərlər</span></a>--}}



                    <li><a href="{{route('admin.about')}}"><i class="fa fa-first-order"></i>
                            <span>Haqqinda</span></a></li>

                    <li><a href="{{route('admin.team.index')}}"><i class="fa fa-users"></i>
                            <span>Team</span></a></li>

                    <li><a href="{{route('admin.services.index')}}"><i class="fa fa-cogs"></i>
                            <span>Xidmətlər</span></a></li>



{{--        <li><a href="{{route('admin.project.index')}}"><i class="fa fa-cogs"></i>--}}
{{--                            <span>Layiheler</span></a></li>--}}

{{--                    <li><a><i class=" fa fa-th-list"></i>--}}
{{--                            <span>Services</span></a>--}}

{{--                        <ul class="navigation navigation-main navigation-accordion">--}}
{{--                            @if(count($services)>0)--}}
{{--                                @foreach($services as $servis)--}}
{{--                                    <li><a href="{{route('admin.services.index',$servis->id)}}">--}}
{{--                                            <span>--}}
{{--                                                 {{$servis->name  ?? ''}}--}}
{{--                                            </span></a>--}}
{{--                                    <li>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <li><a href="{{route('admin.config')}}"><i class="fa fa-cogs"></i> <span>Parametrlər</span></a></li>

                    <li><a href="{{route('admin.photo.index')}}"><i class="fa fa-picture-o"></i> <span>Gallery</span></a></li>

                    <li><a href="{{route('admin.slider.index')}}"><i class="fa fa-cogs"></i> <span>Slider</span></a>
                    </li>
                    <li><a href="{{route('ll.list')}}"><i class="fa fa-transgender"></i> <span>Translate</span></a></li>


                    <li><a href="{{route('admin.user')}}"><i class="fa fa-dashboard"></i> <span>Adminlik</span></a></li>
                    <li><a href="{{route('clear.cache')}}"><i class="icon-spinner2 spinner"></i>
                            <span>Keşi Təmizlə</span></a>
                    </li>
                    <li><a href="{{route('admin.logout')}}"><i class="icon-switch2"></i> Çıxış</a></li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
