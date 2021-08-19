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
                                    <h4 class="card-title">Register Event Details</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('website.page.register-intern') }}"
                                       class="btn btn-primary float-right">← Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column p-0 pl-2 m-0">
                                <div class="d-flex">
                                    <span><strong>Event Name:</strong></span>
                                    <p class="pl-2">{{$registeredUsers->title}}</p>
                                </div>
                            </div>
                            <table class="table table-borderless" data-tablesaw-mode="stack">
                                <thead>
                                <tr>
                                    <th scope="col">Applicant Name</th>
                                    <th scope="col">Student Rollno#</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($registeredUsers->getRegisteredInterns) > 0)
                                    @foreach($registeredUsers->getRegisteredInterns as $key => $val)
                                        <tr>
                                            <td>{{!empty($val->getUser) ? $val->getUser->full_name : $val->guest_name}}</td>
                                            <td>{{!empty($val->getUser) ? $val->getUser->student_rollno : ''}}</td>
                                            <td>{{!empty($val->getUser) ? $val->getUser->email : $val->guest_email}}</td>
                                            <td>{{!empty($val->getUser) ? $val->getUser->contact : ''}}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-danger a-btn-custom"
                                                   onclick="deleteRecord(this, '{{ $val->id }}')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/sweetalert.min.js"></script>
    <script>
        function deleteRecord(input, registerInternId) {
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willDelete) => {
                if (willDelete) {
                    axios.get(`/admin/website/pages/register_intern/delete/${registerInternId}`).then(function (response) {
                        swal(response.data.msg);
                        swal({
                            title: response.data.msg,
                            icon: "success",
                            closeOnClickOutside: false
                        }).then((btn) => {
                            location.reload();
                        });
                    }).catch(function (error) {
                        swal({
                            title: error.response.data.msg,
                            icon: "error",
                            dangerMode: true
                        });
                    });
                }
            });
        }
    </script>
@endpush