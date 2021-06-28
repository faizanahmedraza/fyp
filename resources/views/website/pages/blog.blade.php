@extends('website.layouts.master')

@section('content')
    <!-- blog-page-section -->
    <section class="blog-page-section">
        <div class="container">
            <div class="row">
                @foreach($blogs as $key => $val)
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-holder">
                                    <figure class="image"><a href="/blog/detail/{{$val->slug}}"><img src="/assets/images/uploads/pages/blog/{{$val->image}}"
                                                                                           alt=""></a></figure>
                                    <div class="date-box"><span>{{\Carbon\Carbon::parse($val->created_at,'UTC')->isoFormat('Do') }}</span>{{ Str::upper(\Carbon\Carbon::parse($val->created_at,'UTC')->isoFormat('MMMM')) }}</div>
                                </div>
                                <div class="lower-content">
                                    <ul class="info-box clearfix">
                                        <li><a href="#"><i class="far fa-user-circle"></i>{{ $val->author ?? '' }}</a></li>
                                        <li><a href="#"><i class="far fa-comments"></i>3 Comments</a></li>
                                    </ul>
                                    <h2><a href="/blog/detail/{{$val->slug}}">{{ $val->author }}</a></h2>
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
    <!-- blog-section end -->
@endsection