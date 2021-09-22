@extends('cms.layouts.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/toggle-switch.css">
    <link rel="stylesheet" href="/assets/vendors/datatable/css/dataTables.bootstrap4.min.css">
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
                                    <h4 class="card-title">Fyp Proposals</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/admin/fyp-proposals/add" class="btn btn-primary float-right">Add
                                        +</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="display table dataTable table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="1" style="width: 20px;">ID#</th>
                                        <th>Student Name</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Approved / Rejected</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($proposals) > 0)
                                        @foreach($proposals as $key => $proposal)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $proposal->getUser->full_name }}</td>
                                                <td>{{ $proposal->title }}</td>
                                                <td>
                                                    <button href="javascript:void(0);"
                                                            class="btn btn-dark btn-sm"
                                                            disabled>{{ ucfirst($proposal->status) }}</button>
                                                </td>
                                                <td>
                                                    @if($proposal->status === 'pending')
                                                        <a href="javascript:void(0);"
                                                           class="btn btn-success btn-sm"
                                                           onclick="changeStatus(this,'{{$proposal->id}}','approved')">Approved</a>
                                                        <a href="javascript:void(0);"
                                                           class="btn btn-warning btn-sm"
                                                           onclick="changeStatus(this,'{{$proposal->id}}','rejected')">Rejected</a>
                                                    @else
                                                        <span class="d-flex justify-content-center">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="/admin/fyp-proposals/{{$proposal->id}}/detail"
                                                       class="btn btn-info btn-sm">Detail</a>
                                                    @if($proposal->status === 'pending')
                                                        @can('research-proposal-update')
                                                            <a href="/admin/fyp-proposals/{{$proposal->id}}/update"
                                                               class="btn btn-info btn-sm">Update</a>
                                                        @endcan
                                                    @endif
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
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/sweetalert.min.js"></script>
    <script src="/assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $('.table').DataTable();
        });

        function changeStatus(input, proposalId, status) {
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((response) => {
                if (response) {
                    axios.get(`/admin/fyp-proposals/${proposalId}/${status}`).then((response) => {
                            if (response) {
                                swal({
                                    title: response.data.msg,
                                    icon: "success",
                                    closeOnClickOutside: false
                                }).then((btn) => {
                                    window.location.reload();
                                });
                            }
                        }).catch((error) => {
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
