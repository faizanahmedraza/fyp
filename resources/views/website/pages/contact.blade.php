@extends('website.layouts.master')

@push('styles')
    <style>
        .sideNavQuickButton {
            display: none!important;
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
                        <div class="sec-title">
                            <div class="top-text">We’re 24/7 Available</div>
                            <h1>Contact With Us</h1>
                        </div>
                        <div class="text">The aim of ORIC, Jinnah University for women is to promote, cultivate and create community oriented workplaces among specialists, industry accomplices and financing offices.
                        </div>
                        <div class="info-content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 info-column">
                                    <div class="single-info-box">
                                        <div class="icon-box"><i class="flaticon-location"></i></div>
                                        <div class="text">First Floor Building Block-F, Jinnah University for Women, 5-C Nazimabad, Karachi</div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 info-column">
                                    <div class="single-info-box">
                                        <div class="icon-box"><i class="flaticon-contact"></i></div>
                                        <div class="text">
                                            <a href="mailto:info@example.com">oric.juw@gmail.com</a><br/>
                                            <a href="tel:6668880000">(92-21) 36620857-59 EXT: 295, 263</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                    <div class="form-inner">
                        <form method="POST" action="/contact/inquiry"
                              id="contact-form" class="default-form">
                            @csrf
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Whoops!</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email Address" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" placeholder="Phone Number" required>
                            </div>
                            <div class="form-group">
                                <textarea name="message" placeholder="Write here message"></textarea>
                            </div>
                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn style-two" name="submit-form">Submit Comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->
    <!-- map-section -->
    <section class="map-section">
        <div class="google-map-area">
            <div
                    class="google-map"
                    id="contact-google-map"
                    data-map-lat="40.712776"
                    data-map-lng="-74.005974"
                    data-icon-path="images/icons/map-marker.png"
                    data-map-title="Brooklyn, New York, United Kingdom"
                    data-map-zoom="12"
                    data-markers='{
                    "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","images/icons/map-marker.png"]
                }'>

            </div>
        </div>
    </section>
    <!-- map-section end -->
@endsection

@push('scripts')
    <!-- map script -->
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyATY4Rxc8jNvDpsK8ZetC7JyN4PFVYGCGM"></script>
    <script src="/assets/website/js/gmaps.js"></script>
    <script src="/assets/website/js/map-helper.js"></script>
@endpush