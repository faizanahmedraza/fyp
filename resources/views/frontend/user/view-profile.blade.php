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
                                <div class="row">
                                    <div class="col-12">
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
                                                <label>Profile Picture <span
                                                            class="required-class">*</span> @if(!empty($profile->profile_picture))
                                                        <a href="/assets/images/user_profile/{{ $profile->profile_picture }}"
                                                           target="_blank">{{ env('APP_URL') }}
                                                            /assets/images/user_profile/{{$profile->profile_picture}}</a> @endif
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="first_name">First Name <span
                                                            class="required-class">*</span></label>
                                                <input type="text" class="form-control rounded" id="first_name"
                                                       name="first_name" placeholder="Enter First Name"
                                                       value="{{ old('first_name',$profile->first_name) }}" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="last_name">Last Name <span
                                                            class="required-class">*</span></label>
                                                <input type="text" class="form-control rounded" id="last_name"
                                                       name="last_name" placeholder="Enter Last Name"
                                                       value="{{ old('last_name',$profile->last_name) }}" readonly>
                                            </div>
                                        </div>

                                        @if(Auth::user()->roles()->first()->name == 'super-admin')
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="email">Email <span
                                                                class="required-class">*</span></label>
                                                    <input type="email" class="form-control rounded" id="email"
                                                           name="email" placeholder="Enter Email"
                                                           value="{{ old('email',$profile->email) }}" readonly>
                                                </div>
                                            </div>
                                        @else
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="email">Email <span
                                                                class="required-class">*</span></label>
                                                    <input type="email" class="form-control rounded" id="email"
                                                           name="email" placeholder="Enter Email"
                                                           value="{{ old('email',$profile->email) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="event_name">Department </label>
                                                    <input type="text" class="form-control rounded"
                                                           id="department" name="department"
                                                           placeholder="Enter Department"
                                                           value="{{ old('department',$profile->department) }}" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="dob">Designation</label>
                                                    <input type="text" class="form-control rounded"
                                                           id="designation" name="designation"
                                                           placeholder="Enter Designation"
                                                           value="{{ old('designation',$profile->designation) }}" readonly>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="cnic">CNIC</label>
                                                <input type="text" class="form-control rounded allowNumberOnly"
                                                       id="cnic" name="cnic" placeholder="Enter CNIC"
                                                       value="{{ old('cnic',$profile->cnic) }}" maxlength="13" readonly>
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
                                                               id="exampleRadios1" value="male" checked disabled>
                                                        <label class="form-check-label"
                                                               for="exampleRadios1">{{$profile->gender == 'male' ? ucfirst($profile->gender) : ucfirst('female')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="dob">Date of Birth</label>
                                                <input type="text" class="form-control rounded"
                                                       id="dob" name="dob"
                                                       value="{{ old('dob',\Carbon\Carbon::parse($profile->dob)->format('d-m-Y')) }}"
                                                       readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Date of Joining</label>
                                                <input type="text" name="joining_date" class="form-control rounded"
                                                       value="{{old('joining_date',\Carbon\Carbon::parse($profile->joining_date)->format('d-m-Y'))}}"
                                                       readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Description</label>
                                                <div class="input-group">
                                                        <textarea name="profile_detail" class="form-control"
                                                                  rows="3" readonly>{{ old('profile_detail',$profile->profile_detail) }}</textarea>
                                                </div>
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

