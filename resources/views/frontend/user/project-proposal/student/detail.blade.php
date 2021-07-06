@extends('frontend.layouts.master')

@push('styles')
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css">
@endpush

@section('content')
    <main>
        <div class="container-fluid site-width">
            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Research Project Proposal Detail</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/user/student-research-proposals" class="btn btn-primary float-right">← Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ Session::get('success') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="title">Title <span
                                                            class="required-class">*</span></label>
                                                <input type="text" class="form-control rounded"
                                                       value="{{ $research->title }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="investigator_details">Principal and Co-Principal Details
                                                    <span
                                                            class="required-class">*</span></label>
                                                <input type="text" class="form-control rounded"
                                                       value="{{ $research->investigator_details }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="abstract">Abstract <span
                                                            class="required-class">*</span></label>
                                                <input type="text" class="form-control rounded"
                                                       value="{{ $research->abstract }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="agency">Agency where project
                                                    submitted <span
                                                            class="required-class">*</span></label>
                                                <input type="text" class="form-control rounded"
                                                       value="{{ $research->agency }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="amount">Amount Requested <span
                                                            class="required-class">*</span></label>
                                                <input type="text" class="form-control rounded"
                                                       value="{{ $research->amount }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="submission_date">Date of submission <span
                                                            class="required-class">*</span></label>
                                                <input type="text" class="form-control rounded"
                                                       value="{{ $research->submission_date }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                @if(!empty($research->upload_research))
                                                    <div class="custom-file-alert custom-file-alert-secondary alert-dismissible"
                                                         role="alert">
                                                        <a href="{{ Storage::disk('local')->url('uploads/'.$research->upload_research)}}"
                                                           target="_blank">
                                                            Uploaded Project Proposal </a>
                                                    </div>
                                                @endif
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
