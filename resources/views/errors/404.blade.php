@extends('website.layouts.master')

@section('content')
    <!--Page Title-->
    <section class="page-title centred" style="background-image: url(/assets/website/images/background/page-title.jpg);">
        <div id="particles-js" class="particles-pattern">
            <canvas class="particles-js-canvas-el"></canvas>
        </div>
        <div class="container">
            <div class="content-box">
                <h1>Error</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li>Error Page</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- error-section -->
    <section class="error-section centred">
        <div class="container">
            <div class="content-box">
                <h1>404</h1>
                <h2>Oops, This Page Not Be Found !</h2>
                <div class="text">Can't find what you need? Take a moment and do a search<br/> below or start from our
                    <a href="/">Homepage.</a></div>
            </div>
        </div>
    </section>
    <!-- error-section end -->
@endsection