@extends('cms.layouts.master')

@push('styles')
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
                                    <h4 class="card-title">Funded Project</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('website.page.research.funded-project.add') }}"
                                       class="btn btn-primary float-right">Add +</a>
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
                                        <th data-priority="1">#ID</th>
                                        <th data-priority="3">Title</th>
                                        <th data-priority="3">Principle Investigator</th>
                                        <th data-priority="3">Funding Agency</th>
                                        <th data-priority="3">Amount</th>
                                        <th data-priority="1">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($resultSet) > 0)
                                        @foreach ($resultSet as $key => $val)
                                            <tr class="{{$val->is_disabled == 1 ? 'disabled-blur' : '' }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ Str::limit($val->title,20) }}</td>
                                                <td>{{ $val->principle_investigator }}</td>
                                                <td>{{ $val->funding_agency }}</td>
                                                <td>{{ $val->amount }}</td>
                                                <td>
                                                    <a href="{{ route('website.page.research.funded-project.update', ['fundedProjectId' => $val->id]) }}"
                                                       class="btn btn-success btn-primary m-1 {{$val->is_disabled == 1 ? 'disabled-link' : 'enabled-link'}}">Update</a>
                                                    <a href="javascript:void(0)" class="btn btn-danger a-btn-custom"
                                                       onclick="deleteRecord(this, '{{ $val->id }}','{{$val->is_disabled}}')">{{$val->is_disabled == 1 ? 'Enable' : 'Disable'}}</a>
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

        function deleteRecord(input, fundedProjectId, is_disabled) {
            let status = is_disabled === '1' ? "enabled" : "disabled";
            swal({
                title: "Are you sure you want to " + status + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willDelete) => {
                if (willDelete) {
                    axios.get(`/admin/website/pages/res/funded-project/delete/${fundedProjectId}`).then(function (response) {
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