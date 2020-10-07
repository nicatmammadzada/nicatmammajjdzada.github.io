@extends('front.layouts.master')

@section('content')
<main>

    <div class="slider-area ">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center" data-background="{{asset('uploads/photo/').'/'.$about->banner}}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Bizim Haqqımızda</h2>
                            <nav aria-label="breadcrumb ">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Əsas Səhifə</a></li>
                                    <li class="breadcrumb-item"><a href="#">Xidmətlərimiz</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="support-company-area fix pt-10 section-padding30">
        <div class="support-wrapper align-items-end">
            <div class="left-content">

   {!! $about->text1 !!}


            </div>
            <div class="right-content">

                <div class="right-img">
                    <img src="{{asset('uploads/photo/').'/'.$about->photo}}" alt="">
                </div>
                <div class="support-img-cap text-center">
                    <span>2010</span>
                    <p>Since</p>
                </div>
            </div>
        </div>
    </section>


    <div class="testimonial-area t-bg testimonial-padding">
        <div class="container ">
      {!! $about->text !!}
        </div>
    </div>


    <div class="team-area section-padding30">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">

                    <div class="section-tittle section-tittle5 mb-50">
                        <div class="front-text">
                            <h2 class="">Our team</h2>
                        </div>
                        <span class="back-text">exparts</span>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <img src="/front/assets/img/team/team1.png" alt="">
                        </div>
                        <div class="team-caption">
                            <span>UX Designer</span>
                            <h3>Ethan Welch</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <img src="/front/assets/img/team/team2.png" alt="">
                        </div>
                        <div class="team-caption">
                            <span>UX Designer</span>
                            <h3>Ethan Welch</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                    <div class="single-team mb-30">
                        <div class="team-img">
                            <img src="/front/assets/img/team/team3.png" alt="">
                        </div>
                        <div class="team-caption">
                            <span>UX Designer</span>
                            <h3>Ethan Welch</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection
