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
                                    <h4 class="card-title">Your Profile</h4>
                                    <span>({{Auth::user()->roles()->pluck('name')->first() == 'super-admin' ? 'Admin' : ucfirst(Auth::user()->roles()->pluck('name')->first())}})</span>
                                </div>
                                <div class="col-md-6">
                                    <a href="/user/manage-profile" class="btn btn-primary float-right"><i class="fas fa-user-edit mr-1 h6 mb-0"></i> Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="d-flex justify-content-start flex-column">
                                        @if ($profile->profile_picture)
                                            <div class="form-group">
                                                <img src="/assets/images/user_profile/{{ $profile->profile_picture ? $profile->profile_picture : 'not_available.jpg'}}"
                                                     height="100" width="100">
                                            </div>
                                            <div class="form-group">
                                                <label>Profile Picture <span
                                                            class="required-class">*</span> @if(!empty($profile->profile_picture))
                                                        <a href="/assets/images/user_profile/{{ $profile->profile_picture }}"
                                                           target="_blank">{{ env('APP_URL') }}
                                                            /assets/images/user_profile/{{$profile->profile_picture}}</a> @endif
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="d-flex justify-content-start flex-column flex-wrap">
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">First Name <span
                                                        class="required-class">*</span></label> {{ $profile->first_name }}
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">Email <span
                                                        class="required-class">*</span></label> {{ $profile->email }}
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">Roll no <span
                                                        class="required-class">*</span></label> {{ $profile->student_rollno }}
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">Department <span
                                                        class="required-class">*</span></label> {{ $profile->department }}
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">Joining Date <span
                                                        class="required-class">*</span></label> {{ $profile->joining_date }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="d-flex justify-content-start flex-column flex-wrap">
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">Last Name <span
                                                        class="required-class">*</span></label> {{ $profile->last_name }}
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">CNIC <span
                                                        class="required-class">*</span></label> {{ $profile->cnic }}
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">Seat no <span
                                                        class="required-class">*</span></label> {{ $profile->student_seatno }}
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">Designation <span
                                                        class="required-class">*</span></label> {{ $profile->designation }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="d-flex justify-content-start flex-column flex-wrap">
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">Father Name <span
                                                        class="required-class">*</span></label> {{ $profile->father_name }}
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">Contact <span
                                                        class="required-class">*</span></label> {{ $profile->contact }}
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name" class="font-weight-bold">Gender <span
                                                        class="required-class">*</span></label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="form-check-input" type="radio"
                                                        {{ $profile->gender === "male" ? "checked disabled" : "disabled"}}>
                                                <label class="font-weight-bold"
                                                       for="exampleRadios1">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="form-check-input" type="radio"
                                                        {{ $profile->gender === "female" ? "checked disabled" : "disabled"}}>
                                                <label class="font-weight-bold"
                                                       for="exampleRadios1">Female</label>
                                            </div>
                                            <div class="form-group mt-md-2">
                                                <label for="first_name" class="font-weight-bold">Date of Birth <span
                                                            class="required-class">*</span></label> {{ $profile->dob }}
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

