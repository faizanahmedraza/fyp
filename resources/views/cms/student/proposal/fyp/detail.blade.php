@extends('cms.layouts.master')

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
                                    <h4 class="card-title">Fyp Proposal Detail</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/admin/fyp-proposals" class="btn btn-primary float-right">←
                                        Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Student Name </label>
                                                    <input type="text" class="form-control rounded"
                                                           value="{{ $proposal->getUser->full_name }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="title">Title <span
                                                                class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded" id="title"
                                                           name="title" placeholder="Enter Title"
                                                           value="{{ $proposal->title }}" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="investigator_details">Principal Details
                                                        <span
                                                                class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded"
                                                           id="investigator_details"
                                                           name="investigator_details_pi"
                                                           placeholder="Enter Principal Investigator Details"
                                                           value="{{ $proposal->investigator_details_pi }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="investigator_details">Co-Principal Details
                                                        <span
                                                                class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded"
                                                           id="investigator_details"
                                                           name="investigator_details_copi"
                                                           placeholder="Enter Co-Principal Investigator Details"
                                                           value="{{ $proposal->investigator_details_copi }}" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="abstract">Abstract </label>
                                                    <input type="text" class="form-control rounded"
                                                           id="abstract" name="abstract"
                                                           placeholder="Enter Abstract"
                                                           value="{{ old('abstract',$proposal->abstract) }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="agency">Agency where proposal
                                                        submitted </label>
                                                    <input type="text" class="form-control rounded"
                                                           id="agency" name="agency"
                                                           placeholder="Enter Agency Where Project Submitted"
                                                           value="{{ $proposal->agency }}" readonly>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="submission_date">Date of Submission </label>
                                                    <input type="text" name="submission_date"
                                                           id="submission_date_id" value="{{ \Carbon\Carbon::parse($proposal->submission_date)->format('d-m-Y') }}"
                                                           class="form-control read-only-background"
                                                           placeholder="Enter Date" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <a href="{{\Illuminate\Support\Facades\Storage::url('uploads/'.$proposal->upload_research)}}" target="_blank" class="btn btn-dark btn-lg">
                                                        Check
                                                        your uploaded
                                                        file</a>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Status</label>
                                                    <input type="text"
                                                           class="form-control rounded"
                                                           value="{{ $proposal->status }}" readonly>
                                                </div>
                                            </div>
                                        </form>
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