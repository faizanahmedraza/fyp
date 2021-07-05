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
                                    <h4 class="card-title">Your Profile</h4>
                                    <span>({{Auth::user()->roles()->pluck('name')->first() == 'super-admin' ? 'Admin' : ucfirst(Auth::user()->roles()->pluck('name')->first())}})</span>
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
                                        <form action="/admin/manage-profile" method="POST"
                                              enctype="multipart/form-data">
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

                                            @if ($profile->profile_picture)
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <img src="/assets/images/user_profile/{{ $profile->profile_picture ? $profile->profile_picture : 'not_available.jpg'}}"
                                                             height="100" width="100">
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Profile Picture <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                                        <input type="file" name="profile_picture" class="form-control"
                                                               accept=".jpg, .jpeg, .png"
                                                               value="{{ old('profile_picture',$profile->profile_picture) }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Description <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                                        <textarea name="profile_detail" class="form-control"
                                                                  rows="3">{{ old('profile_detail',$profile->profile_detail) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="first_name">First Name <span
                                                                class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded" id="first_name"
                                                           name="first_name" placeholder="Enter First Name"
                                                           value="{{ old('first_name',$profile->first_name) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="last_name">Last Name <span
                                                                class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded" id="last_name"
                                                           name="last_name" placeholder="Enter Last Name"
                                                           value="{{ old('last_name',$profile->last_name) }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="email">Email <span
                                                                class="required-class">*</span></label>
                                                    <input type="email" class="form-control rounded" id="email"
                                                           name="email" placeholder="Enter Email"
                                                           value="{{ old('email',$profile->email) }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="cnic">CNIC</label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="cnic" name="cnic" placeholder="Enter CNIC"
                                                           value="{{ old('cnic',$profile->cnic) }}" maxlength="13">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="contact">Contact</label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="contact" name="contact" placeholder="Enter Contact"
                                                           value="{{ old('contact',$profile->contact) }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label class="">Gender</label>
                                                    <div class="input-group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                   id="exampleRadios1" value="male"
                                                                    {{ old('gender',$profile->gender) === "male" ? "checked" : ""}}>
                                                            <label class="form-check-label"
                                                                   for="exampleRadios1">Male</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                   id="exampleRadios1" value="female"
                                                                    {{ old('gender',$profile->gender) === "female" ? "checked" : ""}}>
                                                            <label class="form-check-label"
                                                                   for="exampleRadios1">Female</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                   id="exampleRadios1" value="other"
                                                                    {{ old('gender',$profile->gender) === "other" ? "checked" : ""}}>
                                                            <label class="form-check-label"
                                                                   for="exampleRadios1">Other</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="dob">Date of Birth</label>
                                                    <input type="text" class="form-control rounded"
                                                           id="dob" name="dob" value="{{ old('dob',$profile->dob) }}"
                                                           readonly>
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
        oldSubmissionDate = '{{ old('submission_date') }}';
        $(function () {
            $(".allowNumberOnly").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });

            $('input[name="dob"]').val();


            $('input[name="dob"]').datepicker({
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
