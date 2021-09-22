@extends('cms.layouts.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/daterangepicker.min.css">
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
                                    <h4 class="card-title">Update Internship</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('website.page.internship') }}" class="btn btn-primary float-right">← Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form method="POST" action="{{ route('website.page.internship.update.data',['internshipId' => $updateInternship->id]) }}"
                                              enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            @if ($errors->any())
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>Whoops!</strong>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif

                                            @if(!empty($updateInternship->image))
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <div class="input-group">
                                                            <img src="{{ asset('assets/images/uploads/pages/internship/'.$updateInternship->image) }}"
                                                                 height="70" width="70">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Image <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                                        <input type="file" name="image" accept=".jpg, .jpeg, .svg, .png">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="cnic">Title</label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="title" name="title" placeholder="Enter CNIC"
                                                           value="{{ old('title',$updateInternship->title) }}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Company <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded"
                                                               name="company" placeholder="Enter Company Name"
                                                               value="{{ old('company',$updateInternship->company) }}" maxlength="55">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label> Education Mode <span class="required-class">*</span></label>
                                                    <select class="form-control" name="mode" id="mode">
                                                        <option value="">Select</option>
                                                        <option value="Online" {{ old('mode',$updateInternship->mode) === 'Online' ? "selected" : "" }}>
                                                            Online
                                                        </option>
                                                        <option value="Physical" {{ old('mode',$updateInternship->mode) === 'Physical' ? "selected" : "" }}>
                                                            Physical
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row" id="location">
                                                <div class="form-group col-md-12">
                                                    <label> Address <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded"
                                                               name="location" placeholder="Enter Location"
                                                               value="{{ old('location',$updateInternship->location) }}" maxlength="50">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label> Description <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                            <textarea name="description" id="description" class="form-control"
                                                      placeholder="Enter Description" rows="3">{{ old('description',$updateInternship->description) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label> Duration <span class="required-class">*</span></label>
                                                    <input type="text" class="form-control" name="duration"
                                                           value="{{old('duration',$updateInternship->duration)}}" placeholder="Enter Time Duration"/>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" name="paid" value="1"
                                                               class="custom-control-input"
                                                               id="is_paid" {{ old('paid',$updateInternship->paid) == 1 ? 'checked' : ''  }}>
                                                        <label class="custom-control-label"
                                                               for="is_paid">Is Paid <span
                                                                    class="required-class">*</span></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-5">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light float-right">
                                                    Save
                                                </button>
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

@push('scripts')
    <script src="/assets/js/moment.min.js"></script>
    <script src="/assets/js/daterangepicker.min.js"></script>
    <script>
        var eventMode = "{{ old('mode',$updateInternship->mode) }}";

        if(eventMode === "Online")
        {
            $("#location").val('').hide();
        }

        $(function () {
            $("#mode").change(function () {
                if($(this).find(":selected").val() === "Online")
                {
                    $("#location").val('').hide();
                } else {
                    $("#location").show();
                }
            });
            $('input[name="duration"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            }).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            }).on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endpush