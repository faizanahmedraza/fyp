@extends('website.layouts.master')

@section('content')
    <!--Page Title-->
    <section class="page-title centred" style="background-image: url(/assets/website/images/background/page-title.jpg);">
        <div id="particles-js" class="particles-pattern">
            <canvas class="particles-js-canvas-el"></canvas>
        </div>
        <div class="container">
            <div class="content-box">
                <h1>{{ $blog->title }}</h1>
                <ul class="bread-crumb clearfix mt-3">
                    <li><a href="/">Home</a></li>
                    <li>News Details</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- blog-details -->
    <section class="sidebar-page-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="inner-box">
                            <div class="image-holder">
                                <figure class="image"><img src="/assets/images/uploads/pages/blog/{{$blog->image}}" alt=""></figure>
                                <div class="date-box"><span>{{\Carbon\Carbon::parse($blog->created_at,'UTC')->isoFormat('Do') }}</span>{{ Str::upper(\Carbon\Carbon::parse($blog->created_at,'UTC')->isoFormat('MMMM')) }}</div>
                            </div>
                            <div class="lower-content">
                                <div class="inner">
                                    <ul class="info-box clearfix">
                                        <li><a href="javascript:void(0);"><i class="far fa-user-circle"></i>{{ $blog->author ?? '' }}</a></li>
                                        <li><a href="#"><i class="far fa-comments"></i>3 Comments</a></li>
                                    </ul>
                                    <h1>{{ $blog->title ?? ''}}</h1>
                                    <div class="text">
                                        <p>{{ $blog->description ?? ''}}</p>
                                    </div>
                                </div>
                                <div class="post-share-option clearfix">
                                    <ul class="tags-list pull-left">
                                        <li><h4>Tags:</h4></li>
                                        <li><a href="#">Research</a>,</li>
                                        <li><a href="#">Science</a>,</li>
                                        <li><a href="#">Professor</a></li>
                                    </ul>
                                    <ul class="social-links pull-right">
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="author-box">
                            <div class="author-inner">
                                <figure class="image-box"><img src="/assets/website/images/resource/author.jpg" alt=""></figure>
                                <h3>Christine Eve</h3>
                                <div class="text">It has survived not only five centuries, but also the leap into
                                    electronic typesetting, remaining unchanged. It was popularised in the sheets
                                    containing.
                                </div>
                            </div>
                        </div>
                        <div class="comments-area">
                            <h1 class="group-title">2 Comments</h1>
                            <div class="comment-box">
                                <div class="comment">
                                    <figure class="image-box"><img src="images/resource/comment-1.jpg" alt=""></figure>
                                    <div class="comment-inner">
                                        <h4>Kevin Martin</h4>
                                        <div class="text">It has survived not only five centuries, but also the leap
                                            into electronic typesetting unchanged. It was popularised in the sheets
                                            containing lorem ipsum is simply free text.
                                        </div>
                                        <div class="replay-btn"><a href="#">Reply</a></div>
                                    </div>
                                </div>
                                <div class="comment">
                                    <figure class="image-box"><img src="images/resource/comment-2.jpg" alt=""></figure>
                                    <div class="comment-inner">
                                        <h4>Sarah Albert</h4>
                                        <div class="text">It has survived not only five centuries, but also the leap
                                            into electronic typesetting unchanged. It was popularised in the sheets
                                            containing lorem ipsum is simply free text.
                                        </div>
                                        <div class="replay-btn"><a href="#">Reply</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comments-form-area">
                            <h1 class="group-title">Leave a Comment</h1>
                            <form action="#" method="post" class="comment-form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="name" placeholder="Your Name" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="email" name="email" placeholder="Email Address" required="">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="message" placeholder="Write Message"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                        <button type="submit" class="theme-btn style-two">Submit Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="sidebar">
                        <div class="sidebar-search sidebar-widget">
                            <h4 class="widget-title">Search</h4>
                            <div class="search-inner">
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <input type="search" name="search-field" placeholder="Search" required="">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-post sidebar-widget">
                            <h4 class="widget-title">Latest Posts</h4>
                            <div class="post-inner">
                                <div class="post">
                                    <figure class="image-box"><a href="blog-details.html"><img
                                                    src="images/resource/post-3.jpg" alt=""></a></figure>
                                    <h5><a href="blog-details.html">Equipping researchers in the developing world</a>
                                    </h5>
                                </div>
                                <div class="post">
                                    <figure class="image-box"><a href="blog-details.html"><img
                                                    src="images/resource/post-4.jpg" alt=""></a></figure>
                                    <h5><a href="blog-details.html">Equipping researchers in the developing world</a>
                                    </h5>
                                </div>
                                <div class="post">
                                    <figure class="image-box"><a href="blog-details.html"><img
                                                    src="images/resource/post-5.jpg" alt=""></a></figure>
                                    <h5><a href="blog-details.html">Equipping researchers in the developing world</a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-categories sidebar-widget">
                            <h4 class="widget-title">Categories</h4>
                            <ul class="categories-list clearfix">
                                <li><a href="#">Researches</a></li>
                                <li><a href="#">Science</a></li>
                                <li><a href="#">Education</a></li>
                                <li><a href="#">Phathology</a></li>
                                <li><a href="#">Chemistry</a></li>
                            </ul>
                        </div>
                        <div class="sidebar-tags sidebar-widget">
                            <h4 class="widget-title">Tags</h4>
                            <ul class="tags-list clearfix">
                                <li><a href="#">Researches</a>,</li>
                                <li><a href="#">Science</a>,</li>
                                <li><a href="#">Education</a>,</li>
                                <li><a href="#">Phathology</a>,</li>
                                <li><a href="#">Chemistry</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->
@endsection