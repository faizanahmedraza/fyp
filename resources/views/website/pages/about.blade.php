@extends('website.layouts.master')

@push('styles')
    <style>
        .sideNavQuickButton {
            display: none !important;
        }
    </style>
@endpush

@section('content')
    <!-- contact-section -->
    <section class="contact-section sec-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content-box">
                        <div class="sec-title mt-0">
                            <h1>About Us</h1>
                        </div>
                        <div class="text">The aim of ORIC, Jinnah University for women is to promote, cultivate and
                            create community oriented workplaces among specialists, industry accomplices and financing
                            offices. We, here at ORIC are making open doors for academia at all levels to connect with
                            industry to work for commercialization of research.
                        </div>
                        <div class="info-content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 info-column">
                                    <div class="single-info-box">
                                        <div class="icon-box"><i class="flaticon-location"></i></div>
                                        <div class="text">First Floor Building Block-F, Jinnah University for Women, 5-C Nazimabad,
                                            Karachi</div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 info-column">
                                    <div class="single-info-box">
                                        <div class="icon-box"><i class="flaticon-contact"></i></div>
                                        <div class="text">
                                            <a href="mailto:info@example.com">oric.juw@gmail.com</a><br/>
                                            <a href="">(92-21) 36620857-59 EXT: 295, 263</a>
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
    <!-- contact-section end -->
@endsection