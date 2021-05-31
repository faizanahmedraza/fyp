@extends('frontend.layouts.master')

@push('styles')
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css">
@endpush

@section('content')
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Add Research Project</h4>
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
                                        <form action="/student/apply-for-scoloarship" method="POST">
                                            @csrf
                                            @if($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <a href="/student/research-project-download"
                                                       class="btn btn-outline-primary">Download Template</a>
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="title">Title <span
                                                                class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded" id="title"
                                                           name="title" placeholder="Enter Title"
                                                           value="{{ old('title') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="principal_detail">Principal and Co-Principal Details
                                                        <span
                                                                class="required-class">*</span></label>
                                                    <input type="principal_detail" class="form-control rounded"
                                                           id="principal_detail"
                                                           name="principal_detail"
                                                           placeholder="Enter Principal and Co-Principal Details"
                                                           value="{{ old('principal_detail') }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="abstract">Abstract </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="abstract" name="abstract"
                                                           placeholder="Enter Abstract"
                                                           value="{{ old('abstract') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="agency_for_project">Agency where project
                                                        submitted </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="agency_for_project" name="agency_for_project"
                                                           placeholder="Enter Agency Where Project Submitted"
                                                           value="{{ old('agency_for_project') }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="account_requested">Account Requested </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="account_requested" name="account_requested"
                                                           placeholder="Enter Account Requested"
                                                           value="{{ old('account_requested') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="date_of_submission">Date of submission </label>
                                                    <input type="text" name="date_of_submission" id="date_of_submission_id" value=""
                                                           class="form-control read-only-background" placeholder="Enter Date" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="upload_project_research">Upload Project </label>
                                                    <input type="file" name="upload_project_research"
                                                           class="form-control"
                                                           accept=".docx,.pdf" id="upload_project"
                                                           value="{{ old('upload_project_research') }}">
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Save</button>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        oldSubmissionDate = '{{ old('date_of_submission') }}';
        $(function () {
            $('input[name="date_of_submission"]').val();


            $('input[name="date_of_submission"]').datepicker({
                format: "yyyy-mm-dd",
                endDate:  new Date(),
                autoclose: true,
                clearBtn: true,
            }).on('changeDate', function() {
                $(".child-div").show();
            });
        });
    </script>
@endpush