@extends('cms.layouts.master')

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
                                    <h4 class="card-title">Update Fyp Project</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/admin/fyp-projects" class="btn btn-primary float-right">← Back</a>
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
                                        <form action="/admin/fyp-projects/{{$project->id}}/update" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @if($errors->any())
                                                <div class="alert alert-danger">
                                                    <strong>Whoops!</strong>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

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

                                            <div class="form-group col-md-12">
                                                <label for="submission_date">Date of submission </label>
                                                <input type="text" name="submission_date"
                                                       id="submission_date_id" value="{{ old('submission_date',\Carbon\Carbon::parse($project->submission_date)->format('d-m-Y')) }}"
                                                       class="form-control"
                                                       placeholder="Enter Date" readonly>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <a href="{{\Illuminate\Support\Facades\Storage::url('uploads/'.$project->upload_project)}}" target="_blank" class="btn btn-dark btn-lg">
                                                        Check
                                                        your uploaded
                                                        file</a>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="upload_project">Upload Project</label>
                                                    <input type="file" name="upload_project"
                                                           class="form-control"
                                                           accept=".docx,.pdf" id="upload_project"
                                                           value="{{ old('upload_project',$project->upload_project) }}">
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Submit</button>
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
        oldSubmissionDate = '{{ old('submission_date',\Carbon\Carbon::parse($project->submission_date)->format('d-m-Y')) }}';
        $(function () {
            $(".allowNumberOnly").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });

            $('input[name="submission_date"]').val();


            $('input[name="submission_date"]').datepicker({
                format: "dd-mm-yyyy",
                endDate: new Date(),
                autoclose: true,
                clearBtn: true,
            }).on('changeDate', function () {
                $(".child-div").show();
            });
        });
    </script>
@endpush