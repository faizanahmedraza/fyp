@extends('frontend.layouts.master')

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
                                    <h4 class="card-title">Fyp Project Detail</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/user/fyp-projects" class="btn btn-primary float-right">←
                                        Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Student Name <span
                                                            class="required-class">*</span></label>
                                                <input type="text" class="form-control rounded" value="{{ $project->getUser->full_name ?? '' }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Proposal Title <span
                                                            class="required-class">*</span></label>
                                                <input type="text" class="form-control rounded" value="{{ $project->getProposal->title ?? '' }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Date of submission </label>
                                                <input type="text"
                                                       class="form-control rounded"
                                                       value="{{ $project->submission_date }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <a href="{{\Illuminate\Support\Facades\Storage::url('uploads/'.$project->upload_project)}}" target="_blank" class="btn btn-dark btn-lg">
                                                    Check
                                                    your uploaded
                                                    file</a>
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