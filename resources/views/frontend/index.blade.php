@extends('frontend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid site-width">
            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h4 class="card-title">Dashboard</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                                    <div class="card cstBlackColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-check fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Proposals(Approved)</span><br>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $approvedProposals }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                                    <div class="card cstPurpleColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-times fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Proposals(Rejected)</span><br>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $rejectedProposals }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                                    <div class="card cstRedColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-check fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Projects(Approved)</span><br>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">0</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
                                    <div class="card cstYellowColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-times fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Projects(Rejected)</span><br>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">0</h2>
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
