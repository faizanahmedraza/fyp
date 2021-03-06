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
                                    <h4 class="card-title">Update User</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/admin/manage-users" class="btn btn-primary float-right">← Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form action="/admin/update-user/{{$user->id}}" method="POST">
                                            @method('PUT')
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
                                                <div class="form-group col-md-6">
                                                    <label for="first_name">First Name <span
                                                                class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded" id="first_name"
                                                           name="first_name" placeholder="Enter First Name"
                                                           value="{{ old('first_name',$user->first_name) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="last_name">Last Name <span
                                                                class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded" id="last_name"
                                                           name="last_name" placeholder="Enter Last Name"
                                                           value="{{ old('last_name',$user->last_name) }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="email">Father Name </label>
                                                    <input type="text" class="form-control rounded" id="father_name"
                                                           name="father_name" placeholder="Enter Father Name"
                                                           value="{{ old('father_name',$user->father_name) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email">Email <span
                                                                class="required-class">*</span></label>
                                                    <input type="email" class="form-control rounded" id="email"
                                                           name="email" placeholder="Enter Email"
                                                           value="{{ old('email',$user->email) }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="cnic">CNIC</label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="cnic" name="cnic" placeholder="Enter CNIC"
                                                           value="{{ old('cnic',$user->cnic) }}" minlength="13"
                                                           maxlength="13">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="contact">Contact</label>
                                                    <input type="text" class="form-control rounded"
                                                           id="contact" name="contact" placeholder="Enter Contact"
                                                           value="{{ old('contact',$user->contact) }}" maxlength="13"
                                                           minlength="11">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="event_name">Department </label>
                                                    <input type="text" class="form-control rounded"
                                                           id="department" name="department"
                                                           placeholder="Enter Department"
                                                           value="{{ old('department',$user->department) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="dob">Designation</label>
                                                    <input type="text" class="form-control rounded"
                                                           id="designation" name="designation"
                                                           placeholder="Enter Designation"
                                                           value="{{ old('designation',$user->designation) }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label class="">Gender</label>
                                                    <div class="input-group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                   id="exampleRadios1" value="male"
                                                                    {{ old('gender',$user->gender) === "male" ? "checked" : ""}}>
                                                            <label class="form-check-label"
                                                                   for="exampleRadios1">Male</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                   id="exampleRadios1" value="female"
                                                                    {{ old('gender',$user->gender) === "female" ? "checked" : ""}}>
                                                            <label class="form-check-label"
                                                                   for="exampleRadios1">Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="dob">Date of Birth</label>
                                                    <input type="text" class="form-control rounded"
                                                           id="dob" name="dob" value="{{ old('dob',$user->dob) }}"
                                                           readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <label>User Roles <span class="required-class">*</span></label>
                                            </div>
                                            @if(count($roles) > 0)
                                                <div class="form-row">
                                                    @foreach($roles as $key => $val)
                                                        <div class="form-group col-md-2 role">
                                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                                <input type="checkbox" class="custom-control-input"
                                                                       id="role_id{{$key}}" name="role"
                                                                       value="{{ $val->name }}" {{ old("role",$userRole) == $val->name ? 'checked' : '' }}>
                                                                <label class="custom-control-label checkbox-primary outline text-nowrap"
                                                                       for="role_id{{$key}}">{{ $val->name }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
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
        $(function () {
            $(".allowNumberOnly").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });

            $('input[name="dob"]').val();

            $('input[name="dob"]').datepicker({
                format: "dd-mm-yyyy",
                endDate: '01-01-2004',
                autoclose: true,
                clearBtn: true,
            }).on('changeDate', function () {
                $(".child-div").show();
            });

            $(".allowNumberOnly").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });

            $('input:checkbox').click(function () {
                $('input:checkbox').not(this).prop('checked', false);
            });
        });
    </script>
@endpush