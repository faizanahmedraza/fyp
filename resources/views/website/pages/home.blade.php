@extends('website.layouts.master')

@section('content')
    <!-- main-slider -->
    <section class="main-slider">
        <div class="main-slider-carousel owl-carousel owl-theme">
            @if (count($resultSet) > 0)
                @foreach ($resultSet as $key => $val)
                    <div class="slide cstmBanner slide{{ $key + 1 }}">
                        <div class="container">
                            <div class="content-box">
                                <div class="top-text">Researcher & Professors</div>
                                <h1>{{ $val->description }}</h1>
                                <div class="btn-box"><a href="#" class="theme-btn style-one">Discover More</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="slide" style="background-image:url(images/main-slider/slider-1.jpg)">
                    <div class="container">
                        <div class="content-box">
                            <div class="top-text">Researcher & Professors</div>
                            <h1>No Research is Ever Quite Complete</h1>
                            <div class="btn-box"><a href="#" class="theme-btn style-one">Discover More</a></div>
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
                        <figure class="image image-1"><img src="/assets/website/images/resource/welcome-1.jpg" alt="">
                        </figure>
                        <figure class="image image-2 wow fadeInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <img src="/assets/website/images/resource/welcome-2.jpg" alt=""></figure>
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
                        <div class="btn-box"><a href="#" class="theme-btn style-two">Discover More</a></div>
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
                    <h1>Award Winner Research Center</h1>
                </div>
                <div class="right-content pull-right">
                    <a href="contact.html" class="theme-btn style-one">Contact With Us</a>
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
                            <h3><a href="research-details.html">Bacteria Research</a></h3>
                            <div class="text">Lorem ipsum is simply dolor sit amet con adipiscing elit. Etiam convallis
                                elit id impedie.
                            </div>
                            <div class="link-btn"><a href="research-details.html">Learn More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 research-block">
                    <div class="single-research-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-molecular"></i></div>
                            <h3><a href="research-details.html">Medicale Research</a></h3>
                            <div class="text">Lorem ipsum is simply dolor sit amet con adipiscing elit. Etiam convallis
                                elit id impedie.
                            </div>
                            <div class="link-btn"><a href="research-details.html">Learn More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 research-block">
                    <div class="single-research-box wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-dna-structure"></i></div>
                            <h3><a href="research-details.html">Dna Structure Research</a></h3>
                            <div class="text">Lorem ipsum is simply dolor sit amet con adipiscing elit. Etiam convallis
                                elit id impedie.
                            </div>
                            <div class="link-btn"><a href="research-details.html">Learn More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- research-fields end -->


    <!-- testimonial-section -->
    <section class="testimonial-section">
        <div class="container">
            <div class="inner-container">
                <h1 class="title-text">Testimonials</h1>
                <div class="bxslider ">
                    <div class="slider-content">
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-12 col-sm-12 thumb-column">
                                <div class="slider-pager">
                                    <ul class="thumb-box">
                                        @foreach($testimonials as $key => $val)
                                            <li>
                                                <a class="active" data-slide-index="{{$key}}" href="#">
                                                    <figure><img
                                                                src="/assets/images/uploads/pages/{{$val->profile_picture}}"
                                                                alt="">
                                                    </figure>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12 inner-column">
                                <div class="inner-box">
                                    <figure class="image-box"><img
                                                src="/assets/images/uploads/pages/{{$testimonials[0]->profile_picture}}"
                                                alt="">
                                    </figure>
                                    <div class="content-box">
                                        <div class="text">{{ $testimonials[0]->description ?? '' }}
                                        </div>
                                        <div class="author-info">
                                            <h5 class="name">{{ $testimonials[0]->name ?? '' }}</h5>
                                            <span class="designation">{{ $testimonials[0]->designation ?? '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-content">
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-12 col-sm-12 thumb-column">
                                <div class="slider-pager">
                                    <ul class="thumb-box">
                                        @foreach($testimonials as $key => $val)
                                            <li>
                                                <a class="active" data-slide-index="{{$key}}" href="#">
                                                    <figure><img
                                                                src="/assets/images/uploads/pages/{{$val->profile_picture}}"
                                                                alt="">
                                                    </figure>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12 inner-column">
                                <div class="inner-box">
                                    <figure class="image-box"><img
                                                src="/assets/images/uploads/pages/{{$testimonials[1]->profile_picture}}"
                                                alt="">
                                    </figure>
                                    <div class="content-box">
                                        <div class="text">{{ $testimonials[1]->description ?? '' }}
                                        </div>
                                        <div class="author-info">
                                            <h5 class="name">{{ $testimonials[1]->name ?? '' }}</h5>
                                            <span class="designation">{{ $testimonials[1]->designation ?? '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-content">
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-12 col-sm-12 thumb-column">
                                <div class="slider-pager">
                                    <ul class="thumb-box">
                                        @foreach($testimonials as $key => $val)
                                            <li>
                                                <a class="active" data-slide-index="{{$key}}" href="#">
                                                    <figure><img
                                                                src="/assets/images/uploads/pages/{{$val->profile_picture}}"
                                                                alt="">
                                                    </figure>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12 inner-column">
                                <div class="inner-box">
                                    <figure class="image-box"><img
                                                src="/assets/images/uploads/pages/{{$testimonials[2]->profile_picture}}"
                                                alt="">
                                    </figure>
                                    <div class="content-box">
                                        <div class="text">{{ $testimonials[2]->description ?? '' }}
                                        </div>
                                        <div class="author-info">
                                            <h5 class="name">{{ $testimonials[2]->name ?? '' }}</h5>
                                            <span class="designation">{{ $testimonials[2]->designation ?? '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-section end -->


    <!-- researches-section -->
    <section class="researches-section sec-pad">
        <div class="large-container">
            <div class="inner-container">
                <div class="sec-title text-center">
                    <div class="top-text">JUW Researches</div>
                    <h1>We’re Researching</h1>
                </div>
                <div class="inner-content clearfix">
                    <div class="single-item wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><a href="research-details.html"><img
                                            src="images/resource/research-1.jpg" alt=""></a></figure>
                            <div class="lower-content">
                                <h4><a href="research-details.html">Chemical Formula</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="single-item wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><a href="research-details.html"><img
                                            src="images/resource/research-2.jpg" alt=""></a></figure>
                            <div class="lower-content">
                                <h4><a href="research-details.html">Human Body</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="single-item wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><a href="research-details.html"><img
                                            src="images/resource/research-3.jpg" alt=""></a></figure>
                            <div class="lower-content">
                                <h4><a href="research-details.html">Cancer Therapies</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="single-item wow fadeInUp" data-wow-delay="900ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><a href="research-details.html"><img
                                            src="images/resource/research-4.jpg" alt=""></a></figure>
                            <div class="lower-content">
                                <h4><a href="research-details.html">Blood Cells</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="single-item wow fadeInUp" data-wow-delay="1200ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><a href="research-details.html"><img
                                            src="images/resource/research-5.jpg" alt=""></a></figure>
                            <div class="lower-content">
                                <h4><a href="research-details.html">Pathology Research</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="discover-btn"><a href="#" class="theme-btn style-two">Discover More</a></div>
            </div>
        </div>
    </section>
    <!-- researches-section end -->


    <!-- team-section -->
    <section class="team-section sec-pad">
        <div class="container">
            <div class="sec-title text-center">
                <div class="top-text">Research Experts</div>
                <h1>Meet ORIC Team</h1>
            </div>
            <div class="team-details">
                <div class="inner-box">
                    <div class="image-box">
                        <figure class="image"><img src="/assets/images/uploads/pages/{{$orics[0]->profile_picture}}"
                                                   alt=""></figure>
                        <div class="link"><a href="team-details.html">View More Details</a></div>
                    </div>
                    <div class="content-box">
                        <div class="info">
                            <h2 class="name">{{ $orics[0]->name ?? '' }}</h2>
                            <span class="designation">{{ $orics[0]->designation ?? '' }}</span>
                        </div>
                        <div class="text">{{ $orics[0]->description ?? '' }}
                        </div>
                        <div class="progress-content">
                            <div class="single-progress-box">
                                <h5>Research in Science</h5>
                                <div class="progress" data-value="98">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0"
                                         aria-valuemax="100">
                                        <div class="value-holder"><span class="value"></span>%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-progress-box">
                                <h5>Research in Cancer</h5>
                                <div class="progress" data-value="66">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="66" aria-valuemin="0"
                                         aria-valuemax="100">
                                        <div class="value-holder"><span class="value"></span>%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="social-links clearfix">
                            <li><a href="#"><i class="fab fa-skype"></i></a></li>
                            <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="team-block-area">
                <div class="row">
                    @foreach($orics as $key => $val)
                        <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                            <div class="single-team-block wow fadeInUp" data-wow-delay="00ms"
                                 data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-holder">
                                        <figure class="image"><a href="team-details.html"><img
                                                        src="/assets/images/uploads/pages/{{$val->profile_picture}}"
                                                        alt=""></a></figure>
                                        <ul class="social-links clearfix">
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="lower-content">
                                        <h4><a href="team-details.html">{{ $val->name ?? '' }}</a></h4>
                                        <div class="designation">{{ $val->designation ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- team-section -->


    <!-- video-section -->
    <section class="video-section centred" style="background-image: url(images/background/video-bg.jpg);">
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
                                <span class="count-text" data-speed="1500" data-stop="2340">0</span>
                            </div>
                            <div class="text">Articles</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                        <div class="single-counter-box">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="1403">0</span>
                            </div>
                            <div class="text">Researches</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                        <div class="single-counter-box">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="8400">0</span>
                            </div>
                            <div class="text">Satisfied</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 counter-column">
                        <div class="single-counter-box">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="3240">0</span>
                            </div>
                            <div class="text">Members</div>
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
                                    <figure class="image"><a href="blog-details.html"><img src="/assets/images/uploads/pages/blog/{{$val->image}}"
                                                                                           alt=""></a></figure>
                                    <div class="date-box"><span>{{\Carbon\Carbon::parse($val->created_at,'UTC')->isoFormat('Do') }}</span>{{ Str::upper(\Carbon\Carbon::parse($val->created_at,'UTC')->isoFormat('MMMM')) }}</div>
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


    <!-- clients-section -->
    <section class="clients-section centred">
        <div class="container">
            <div class="clients-carousel owl-carousel owl-theme owl-dots-none">
                <figure class="image-box"><a href="#"><img src="images/clients/1.png" alt=""></a></figure>
                <figure class="image-box"><a href="#"><img src="images/clients/2.png" alt=""></a></figure>
                <figure class="image-box"><a href="#"><img src="images/clients/3.png" alt=""></a></figure>
                <figure class="image-box"><a href="#"><img src="images/clients/4.png" alt=""></a></figure>
                <figure class="image-box"><a href="#"><img src="images/clients/5.png" alt=""></a></figure>
            </div>
        </div>
    </section>
    <!-- clients-section end -->
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