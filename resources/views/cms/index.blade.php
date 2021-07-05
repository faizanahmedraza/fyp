@extends('cms.layouts.master')

@push('styles')
    <style>
        .cstSuccessColor {
            background-color: #59ba62;
        }
    </style>
@endpush

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
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <div class="card cstSuccessColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-user-check fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Users</span><br>
                                                        <p class="mb-0 font-weight-bold tx-s-12 text-primary">Active
                                                            Users</p>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $activeUsers - 1 }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <div class="card cstSuccessColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-user-alt-slash fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Users</span><br>
                                                        <p class="mb-0 font-weight-bold tx-s-12 text-primary">Block
                                                            Users</p>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $blockUsers }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <div class="card cstSuccessColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-user-check fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Users</span><br>
                                                        <p class="mb-0 font-weight-bold tx-s-12 text-primary">Admins</p>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $admins }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <div class="card cstSuccessColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-user-check fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Users</span><br>
                                                        <p class="mb-0 font-weight-bold tx-s-12 text-primary">Students</p>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $students }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <div class="card cstSuccessColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-user-check fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Users</span><br>
                                                        <p class="mb-0 font-weight-bold tx-s-12 text-primary">Researchers</p>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $researchers }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <div class="card cstSuccessColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-check fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Project Proposals</span><br>
                                                        <p class="mb-0 font-weight-bold tx-s-12 text-primary">
                                                            Approved</p>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $approvedProposals }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <div class="card cstSuccessColor">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="fas fa-times fa-3x fa-fw mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <div class="media-body align-self-center text-white">
                                                        <span class="mb-0 h5 font-w-600">Project Proposals</span><br>
                                                        <p class="mb-0 font-weight-bold tx-s-12 text-primary">
                                                            Rejected</p>
                                                    </div>
                                                    <h2 class="card-liner-title text-white">{{ $rejectedProposals }}</h2>
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

@push('scripts')
@endpush
