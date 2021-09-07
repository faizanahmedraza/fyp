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
                                    <h4 class="card-title">Update Fyp Proposal</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/admin/fyp-proposals" class="btn btn-primary float-right">← Back</a>
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
                                        <form action="/admin/fyp-proposals/{{$proposal->id}}/update" method="POST" enctype="multipart/form-data">
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
                                                    <input type="text" class="form-control rounded" value="{{ $proposal->getUser->full_name ?? '' }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="title">Title <span
                                                                class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded" id="title"
                                                           name="title" placeholder="Enter Title"
                                                           value="{{ old('title',$proposal->title) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="investigator_details">Principal and Co-Principal Details
                                                        <span
                                                                class="required-class">*</span></label>
                                                    <input type="investigator_details" class="form-control rounded"
                                                           id="investigator_details"
                                                           name="investigator_details"
                                                           placeholder="Enter Principal and Co-Principal Investigator Details"
                                                           value="{{ old('investigator_details',$proposal->investigator_details) }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="abstract">Abstract </label>
                                                    <input type="text" class="form-control rounded"
                                                           id="abstract" name="abstract"
                                                           placeholder="Enter Abstract"
                                                           value="{{ old('abstract',$proposal->abstract) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="agency">Agency where proposal
                                                        submitted </label>
                                                    <input type="text" class="form-control rounded"
                                                           id="agency" name="agency"
                                                           placeholder="Enter Agency Where Project Submitted"
                                                           value="{{ old('agency',$proposal->agency) }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="amount">Amount Requested </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="amount" name="amount"
                                                           placeholder="Enter Account Requested"
                                                           value="{{ old('amount',$proposal->amount) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="submission_date">Date of submission </label>
                                                    <input type="text" name="submission_date"
                                                           id="submission_date_id" value="{{ old('submission_date',$proposal->submission_date) }}"
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
                                                    <label for="upload_research">Upload Project Proposal</label>
                                                    <input type="file" name="upload_research"
                                                           class="form-control"
                                                           accept=".docx,.pdf" id="upload_proposal"
                                                           value="{{ old('upload_research',$proposal->upload_research) }}">
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
        oldSubmissionDate = '{{ old('submission_date',$proposal->submission_date) }}';
        $(function () {
            $(".allowNumberOnly").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });

            $('input[name="submission_date"]').val();


            $('input[name="submission_date"]').datepicker({
                format: "yyyy-mm-dd",
                endDate: new Date(),
                autoclose: true,
                clearBtn: true,
            }).on('changeDate', function () {
                $(".child-div").show();
            });
        });
    </script>
@endpush