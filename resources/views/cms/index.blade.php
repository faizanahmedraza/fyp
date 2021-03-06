@extends('cms.layouts.master')

@push('styles')
    <style>
        .heading-font {
          font-size: 18px;
        }

        .cstRedColor {
            width: 100%;
            height: 80px;
        }

        .cstm-opacity {
            opacity: 0.87;
        }

        #afterimage::before {
            content: "";
            background: url('{{asset('assets/images/dashboard-pic.jpg')}}');
            object-fit: cover;
            max-width: 100%;
            min-height: 100vh;
            max-height: 100%;
            background-size: cover;
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            opacity: 0.72;
        }
        .text-responsive {
            font-size: calc(100% + 1vw + 1vh);
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
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="card rounded-0 cstm-opacity">
                                        <div class="card-header p-4 font-weight-bold heading-font">USERS</div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="fas fa-user-check fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                                    <span class="mb-0 h5 font-w-600"
                                                                          style="font-size: 1rem!important;">Students</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $students }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="fas fa-user-check fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                                    <span class="mb-0 h5 font-w-600"
                                                                          style="font-size: 1rem!important;">Researchers</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $researchers }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="fas fa-user-check fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                                    <span class="mb-0 h5 font-w-600"
                                                                          style="font-size: 1rem!important;">Faculty Members</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $facultyMembers }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="fas fa-user-check fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                                    <span class="mb-0 h5 font-w-600"
                                                                          style="font-size: 1rem!important;">ORIC Members</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $oricMembers }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                    <div class="card rounded-0 cstm-opacity">
                                        <div class="card-header p-4 font-weight-bold heading-font">PROPOSALS</div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="fas fa-check fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                                    <span class="mb-0 h5 font-w-600 text-responsive"
                                                                          style="font-size: 1rem!important;">FYP Proposals (Approved)</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $approvedFypProposals }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="fas fa-times fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600 text-responsive"
                                                              style="font-size: 1rem!important;">FYP Proposals (Rejected)</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $rejectedFypProposals }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="fas fa-check fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600 text-responsive"
                                                              style="font-size: 1rem!important;">Funded Proposals (Approved)</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $approvedFundedProposals }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="fas fa-times fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600 text-responsive"
                                                              style="font-size: 1rem!important;">Funded Proposals (Rejected)</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $rejectedFundedProposals }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 mt-lg-4">
                                    <div class="card rounded-0 cstm-opacity">
                                        <div class="card-header p-4 font-weight-bold heading-font">PROJECTS</div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="fas fa-check fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                                    <span class="mb-0 h5 font-w-600 text-responsive"
                                                                          style="font-size: 1rem!important;">FYP Projects</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $approvedFypProjects }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="fas fa-check fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600 text-responsive"
                                                              style="font-size: 1rem!important;">Funded Projects</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $approvedFundedProjects }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 mt-lg-4">
                                    <div class="card rounded-0 cstm-opacity">
                                        <div class="card-header p-4 font-weight-bold heading-font">ACTIVITIES</div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="icon-grid fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600"
                                                              style="font-size: 1rem!important;">Events</span><br>
                                                                </div>
                                                                <h2 class="card-liner-title text-white">{{ $events }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card cstRedColor border-bottom border-success border-w-5 border-bottom m-2 zoom">
                                                    <div class="card-body">
                                                        <div class='d-flex px-0 px-lg-2 align-self-center'>
                                                            <i class="icon-grid fa-2x fa-fw mt-2 text-white"></i>
                                                            <div class='card-liner-content'>
                                                                <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600"
                                                              style="font-size: 1rem!important;">Internships</span><br>
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
                    </div>
                </div>
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
@endsection
