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
                                    <h4 class="card-title">View User</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/admin/manage-users" class="btn btn-primary float-right">← Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="d-flex justify-content-start flex-column flex-wrap">
                                            <div class="form-group">
                                                <label for="first_name" class="font-weight-bold">First Name <span
                                                            class="required-class">*</span></label> {{ $user->first_name }}
                                            </div>
                                            <div class="form-group">
                                                <label for="first_name" class="font-weight-bold">Email <span
                                                            class="required-class">*</span></label> {{ $user->email }}
                                            </div>
                                            <div class="form-group">
                                                <label for="first_name" class="font-weight-bold">Department <span
                                                            class="required-class">*</span></label> {{ $user->department }}
                                            </div>
                                            <div class="form-group">
                                                <label for="first_name" class="font-weight-bold">Date of Birth <span
                                                            class="required-class">*</span></label> {{ $user->dob }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="d-flex justify-content-start flex-column flex-wrap">
                                            <div class="form-group">
                                                <label for="first_name" class="font-weight-bold">Last Name <span
                                                            class="required-class">*</span></label> {{ $user->last_name }}
                                            </div>
                                            <div class="form-group">
                                                <label for="first_name" class="font-weight-bold">CNIC <span
                                                            class="required-class">*</span></label> {{ $user->cnic }}
                                            </div>
                                            <div class="form-group">
                                                <label for="first_name" class="font-weight-bold">Designation <span
                                                            class="required-class">*</span></label> {{ $user->designation }}
                                            </div>
                                            <div class="form-group">
                                                <label for="first_name" class="font-weight-bold">User Role <span
                                                            class="required-class">*</span></label> {{ $userRole }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="d-flex justify-content-start flex-column flex-wrap">
                                            <div class="form-group">
                                                <label for="first_name" class="font-weight-bold">Father Name <span
                                                            class="required-class">*</span></label> {{ $user->father_name }}
                                            </div>
                                            <div class="form-group">
                                                <label for="first_name" class="font-weight-bold">Contact <span
                                                            class="required-class">*</span></label> {{ $user->contact }}
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="form-check-input" type="radio"
                                                            {{ $user->gender === "male" ? "checked disabled" : "disabled"}}>
                                                    <label class="font-weight-bold"
                                                           for="exampleRadios1">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="form-check-input" type="radio"
                                                            {{ $user->gender === "female" ? "checked disabled" : "disabled"}}>
                                                    <label class="font-weight-bold"
                                                           for="exampleRadios1">Female</label>
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