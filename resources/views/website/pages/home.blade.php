@extends('website.layouts.master')

@section('content')
    @php
        $images = $resultSet->pluck('banner')->take(2);
    @endphp
    <!-- main-slider -->
    <section class="main-slider">
        <div class="main-slider-carousel owl-carousel owl-theme">
            @if (count($resultSet) > 0)
                @foreach ($resultSet as $key => $val)
                    <div class="slide cstm-banner slide{{ $key + 1 }}">
                        <div class="container">
                            <div class="content-box">
                                <h2 class="mt-5">{{$val->description }}</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="slide" style="background-image:url(images/main-slider/slider-1.jpg)">
                    <div class="container">
                        <div class="content-box">
                            <h1 class="mt-5">No Research is Ever Quite Complete</h1>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- main-slider end -->


    <!-- intro-section -->
    <section class="intro-section">
        <div class="outer-container clearfix">
            <div class="single-intro-box">
                <div class="inner-box">
                    <div class="icon-box"><i class="fa fa-bullseye"></i></div>
                    <div class="content-box">
                        <div class="text"></div>
                        <h3><a href="#">Mission</a></h3>
                        <p>{{ $aim->mission ?? ''}}</p>
                    </div>
                </div>
            </div>
            <div class="single-intro-box">
                <div class="inner-box">
                    <div class="icon-box"><i class="fa fa-eye"></i></div>
                    <div class="content-box">
                        <div class="text"></div>
                        <h3><a href="#">Vision</a></h3>
                        <p>{{ $aim->vision ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="single-intro-box">
                <div class="inner-box">
                    <div class="icon-box"><i class="fa fa-bars"></i></div>
                    <div class="content-box">
                        <div class="text"></div>
                        <h3><a href="#">Values</a></h3>
                        <p>{{ $aim->values ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- intro-section end -->


    <!-- welcome-section -->
    <section class="welcome-section sec-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box">
                        <figure class="image image-1"><img
                                    src="{{ !empty($images[0]) ? asset('assets/images/uploads/pages/'.$images[0]) : '/assets/website/images/resource/welcome-1.jpg' }}"
                                    alt="">
                        </figure>
                        <figure class="image image-2 wow fadeInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <img src="{{ !empty($images[1]) ? asset('assets/images/uploads/pages/'.$images[1]) : '/assets/website/images/resource/welcome-2.jpg'}}"
                                 alt="" style="max-width: 360px!important; height: 290px!important;"></figure>
                        <div class="text-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <h1>40</h1>
                            <h3>Years of Research Experience</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content-box">
                        <div class="sec-title">
                            <div class="top-text">ORIC</div>
                            <h1>Welcome to </h1>
                        </div>
                        <div class="video-box">
                            <div class="video-inner">
                                <div class="video-btn"><a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s"
                                                          class="lightbox-image" data-caption=""><i
                                                class="flaticon-play-button"></i></a></div>
                                <h2>Office of Research, Innovation & Commercialization – Jinnah University for
                                    Women</h2>
                            </div>
                        </div>
                        <div class="text">ORIC-JUW is an office for the facilitation of researcher; be it the student or
                            faculty, for developing technology solutions to cater the need of society.
                        </div>
                        <ul class="list clearfix">
                            <li>the ideas are transformed into innovative products, services, techniques and processes
                            </li>
                            <li>We help academia to connect with relevant technology sector for commercialization of
                                research.
                            </li>
                            <li>. ORIC helps, academia to connect with industry.</li>
                        </ul>
                        <div class="btn-box"><a href="/success-stories" class="theme-btn style-two">Read More</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- welcome-section end -->


    <!-- cta-section -->
    <section class="cta-section">
        <div class="container">
            <div class="inner-box clearfix">
                <div class="left-content pull-left">
                    <h1>Achievement Of JUW-ORIC</h1>
                </div>
                <div class="right-content pull-right">
                    <a href="/our-news" class="theme-btn style-one">Our News</a>
                </div>
            </div>
        </div>
    </section>
    <!-- cta-section end -->


    <!-- research-fields -->
    <section class="research-fields sec-pad">
        <div class="container">
            <div class="sec-title text-center">
                <div class="top-text">Areas of Research</div>
                <h1>Research Fields</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 research-block">
                    <div class="single-research-box wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-bacteria"></i></div>
                            <h3><a href="javascript:;">Bacteria Research</a></h3>
                            <div class="text">Lorem ipsum is simply dolor sit amet con adipiscing elit. Etiam convallis
                                elit id impedie.
                            </div>
                            <div class="link-btn"><a href="javascript:;">Learn More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 research-block">
                    <div class="single-research-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-molecular"></i></div>
                            <h3><a href="javascript:;">Medicale Research</a></h3>
                            <div class="text">Lorem ipsum is simply dolor sit amet con adipiscing elit. Etiam convallis
                                elit id impedie.
                            </div>
                            <div class="link-btn"><a href="javascript:;">Learn More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 research-block">
                    <div class="single-research-box wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-dna-structure"></i></div>
                            <h3><a href="javascript:;">Dna Structure Research</a></h3>
                            <div class="text">Lorem ipsum is simply dolor sit amet con adipiscing elit. Etiam convallis
                                elit id impedie.
                            </div>
                            <div class="link-btn"><a href="javascript:;">Learn More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- research-fields end -->

    <!-- video-section -->
    <section class="video-section centred"
             style="background-image: url(/assets/website/images/background/video-bg.jpg);">
        <div class="container">
            <div class="inner-box">
                <div class="video-btn"><a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s"
                                          class="lightbox-image" data-caption=""><i
                                class="flaticon-play-button"></i></a></div>
                <h1>One Of The Best Leading Research Center</h1>
            </div>
        </div>
    </section>
    <!-- video-section end -->


    <!-- fact-counter -->
    <section class="fact-counter centred">
        <div class="container">
            <div class="inner-container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                        <div class="single-counter-box">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="{{$users}}">{{$users}}</span>
                            </div>
                            <div class="text">Users</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                        <div class="single-counter-box">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="{{$approvedFypProjects}}">{{$approvedFypProjects}}</span>
                            </div>
                            <div class="text">Fyp Projects</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                        <div class="single-counter-box">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="{{$approvedFundedProjects}}">{{$approvedFundedProjects}}</span>
                            </div>
                            <div class="text">Funded Projects</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                        <div class="single-counter-box">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="{{$events}}">{{$events}}</span>
                            </div>
                            <div class="text">Events</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- fact-counter end -->


    <!-- news-section -->
    <section class="news-section sec-pad">
        <div class="container">
            <div class="sec-title text-center">
                <div class="top-text">From the News & Articles</div>
                <h1>Latest Blog Posts</h1>
            </div>
            <div class="row">
                @foreach($blogs as $key => $val)
                    <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-holder">
                                    <figure class="image"><a href="blog-details.html"><img
                                                    src="/assets/images/uploads/pages/blog/{{$val->image}}"
                                                    alt=""></a></figure>
                                    <div class="date-box">
                                        <span>{{\Carbon\Carbon::parse($val->created_at,'UTC')->isoFormat('Do') }}</span>{{ Str::upper(\Carbon\Carbon::parse($val->created_at,'UTC')->isoFormat('MMMM')) }}
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <ul class="info-box clearfix">
                                        <li><a href="#"><i class="far fa-user-circle"></i>{{ $val->author }}</a></li>
                                    </ul>
                                    <h2><a href="/blog/detail/{{ $val->slug }}">{{ $val->title }}</a></h2>
                                    <div class="link-btn"><a href="blog-details.html"><i
                                                    class="flaticon-right-arrow"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- news-section end -->
@endsection

@push('scripts')
    <script>
        var jsonEncoded = @json($resultSet);
        var publicpath = "{{ asset('assets/images/uploads/pages') }}"
        $.each(jsonEncoded, function (k, v) {
            k += 1;
            if (v.banner) {
                $(".slide" + k + "").css("background", "url(" + publicpath + "/" + v.banner + ")");
            }
        });
    </script>
@endpush