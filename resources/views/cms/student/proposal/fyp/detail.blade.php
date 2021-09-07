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
                                                    <label>Title </label>
                                                    <input type="text" class="form-control rounded"
                                                           value="{{ $proposal->title }}" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Principal and Co-Principal Investigator Details</label>
                                                    <input type="investigator_details" class="form-control rounded"
                                                           value="{{ $proposal->investigator_details }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Abstract </label>
                                                    <input type="text" class="form-control rounded"
                                                           value="{{ $proposal->abstract }}" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Agency where proposal
                                                        submitted </label>
                                                    <input type="text" class="form-control rounded"
                                                           value="{{ $proposal->agency }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Amount Requested </label>
                                                    <input type="text" class="form-control rounded"
                                                           value="{{ $proposal->amount }}" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Date of submission </label>
                                                    <input type="text"
                                                           class="form-control rounded"
                                                           value="{{ $proposal->submission_date }}" readonly>
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
                                                    <label>This application is ?</label>
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