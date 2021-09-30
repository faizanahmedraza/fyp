@extends('frontend.layouts.master')

@push('styles')
    <style>
        .card .card-body {
            height: 106px;
        }
        #afterimage::before{
            content: "";
            background: url('{{asset('assets/images/dashboard-pic.jpg')}}');
            object-fit: cover;
            max-width: 100%;
            height: 100vh;
            background-size: cover;
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            opacity: 0.72;
        }
    </style>
@endpush

@section('content')
    <main>
        <div class="container-fluid site-width">
            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-3">
                    <div id="afterimage" class="card">
                        <div class="card-header border-0 justify-content-between align-items-center">
                            <h4 class="card-title opacity-100 font-weight-bold">Dashboard</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                                    <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom zoom">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-check fa-2x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600 text-break">Fyp Proposals(Approved)</span><br>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $approvedFypProposals }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                                    <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom zoom">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-times fa-2x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600 text-break">Fyp Proposals(Rejected)</span><br>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $rejectedFundedProposals }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                                    <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom zoom">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-check fa-2x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600 text-break">Funded Proposals(Approved)</span><br>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $approvedFundedProposals }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                                    <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom zoom">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-times fa-2x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600 text-break">Funded Proposals(Rejected)</span><br>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $approvedFundedProposals }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                                    <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom zoom">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="icon-grid fa-2x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600 text-break">Events(Registered)</span><br>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $events }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                                    <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom zoom">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="icon-grid fa-2x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600 text-break">Internships(Registered)</span><br>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $interns }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
@endsection
