@extends('website.layouts.master')

@section('content')
    <!--Page Title-->
    <section class="page-title banner">
        <div id="particles-js" class="particles-pattern">
            <canvas class="particles-js-canvas-el"></canvas>
        </div>
        <div class="container">
            <div class="content-box">
                <h1>{{ $resultSet->title ?? '' }}</h1>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- blog-page-section -->
    <section class="blog-page-section">
        <div class="container">
            <div class="row">
                @foreach($blogs as $key => $val)
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-holder">
                                    <figure class="image"><a href="/our-news/{{$val->slug}}/detail"><img
                                                    src="/assets/images/uploads/pages/blog/{{$val->image}}"
                                                    alt=""></a></figure>
                                    <div class="date-box">
                                        <span>{{\Carbon\Carbon::parse($val->created_at,'UTC')->isoFormat('Do') }}</span>{{ Str::upper(\Carbon\Carbon::parse($val->created_at,'UTC')->isoFormat('MMMM')) }}
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <ul class="info-box clearfix">
                                        <li><a href="#"><i class="far fa-user-circle"></i>{{ $val->author ?? '' }}</a>
                                        </li>
                                        <li><a href="#"><i class="far fa-comments"></i>3 Comments</a></li>
                                    </ul>
                                    <h2><a href="/our-news/{{$val->slug}}/detail">{{ $val->title ?? '' }}</a></h2>
                                    <div class="link-btn"><a href="/our-news/{{$val->slug}}/detail"><i
                                                    class="flaticon-right-arrow"></i></a></div>
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

@push('scripts')
    <script>
        var jsonEncoded = @json($resultSet);
        var publicpath = "{{ asset('assets/images/uploads/pages') }}";
        if (jsonEncoded.banner) {
            $(".banner").css("background-image", "url(" + publicpath + "/" + jsonEncoded.banner + ")");
        }
    </script>
@endpush