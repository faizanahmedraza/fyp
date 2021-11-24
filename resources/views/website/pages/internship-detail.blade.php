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
                <h1>{{ $internship->title ?? ''}}</h1>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- intro-section -->
    <section class="intro-section border-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="image-holder mt-2">
                        <figure class="image"><img
                                        src="/assets/images/uploads/pages/internship/{{$internship->image}}"
                                        alt=""></figure>
                    </div>
                    <div class="card border-0">
                        <div class="card-body border-0">
                            <h2 class="card-title">Internship Description</h2>
                            <p class="card-text">{{ $internship->description ?? ''}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- intro-section end-->
@endsection
