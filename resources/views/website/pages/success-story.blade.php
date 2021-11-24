@extends('website.layouts.master')

@section('content')
    <!--Page Title-->
    <section class="page-title banner" style="background-image: url(/assets/website/images/background/page-title.jpg);">
        <div id="particles-js" class="particles-pattern">
            <canvas class="particles-js-canvas-el"></canvas>
        </div>
        <div class="container">
            <div class="content-box">
                <h1>Success Stories</h1>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- blog-page-section -->
    <section class="blog-page-section">
        <div class="container">
            <div class="row">
                @foreach($events as $key => $event)
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-holder">
                                    <figure class="image"><a><img class="cstm-event-img"
                                                                                                          src="/assets/images/uploads/pages/event/{{$event->image}}"
                                                                                                          alt=""></a></figure>
                                    <div class="date-box">
                                        <span>{{\Carbon\Carbon::parse($event->created_at,'UTC')->isoFormat('Do') }}</span>{{ Str::upper(\Carbon\Carbon::parse($event->created_at,'UTC')->isoFormat('MMM')) }}
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <ul class="info-box clearfix">
                                        <li class="d-flex justify-content-between">
                                            <a>{{ $event->title ?? '' }}</a>
                                        </li>
                                    </ul>
                                    <h2>
                                        <a>{{ Str::limit($event->description,20) ?? '' }}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- blog-section end -->
@endsection