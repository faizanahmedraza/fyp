@extends('website.layouts.master')

@push('styles')
    <style></style>
@endpush

@section('content')
    <!--Page Title-->
    <section class="page-title banner" style="background-image: url(/assets/website/images/background/page-title.jpg);">
        <div id="particles-js" class="particles-pattern">
            <canvas class="particles-js-canvas-el"></canvas>
        </div>
        <div class="container">
            <div class="content-box">
                <h1>{{ $gallery->title ?? ''}}</h1>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- intro-section -->
    <section class="intro-section border-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0">
                        <div class="card-header border-0">
                            <h2 class="card-title">Event Description</h2>
                            <p class="card-text">{{ $gallery->description ?? ''}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- intro-section end-->

    <!-- blog-page-section -->
    <section class="blog-page-section">
        <div class="container">
            <div class="row">
                @if(!empty($gallery->getGalleries) > 0)
                    @foreach($gallery->getGalleries as $key => $val)
                        <div class="col-lg-3 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-holder">
                                        <figure class="image"><img class="cstm-event-img"
                                                    src="/assets/images/uploads/pages/event/gallery/{{$val->image}}"
                                                    alt=""></figure>
                                        <div class="date-box">
                                            <span>{{\Carbon\Carbon::parse($val->created_at,'UTC')->isoFormat('Do') }}</span>{{ Str::upper(\Carbon\Carbon::parse($val->created_at,'UTC')->isoFormat('MMMM')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- blog-section end -->
@endsection
