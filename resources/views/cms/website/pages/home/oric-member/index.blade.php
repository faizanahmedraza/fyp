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
                                    <h4 class="card-title">Home Page ORIC Members List</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('website.page.home.oric-member.add') }}" class="btn btn-primary float-right">Add +</a>
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
                                        <th data-priority="3">Name</th>
                                        <th data-priority="3">Designation</th>
                                        <th data-priority="3">Description</th>
                                        <th data-priority="1">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($resultSet) > 0)
                                        @foreach ($resultSet as $key => $home)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $home->name }}</td>
                                                <td>{{ $home->designation }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($home->description, 20) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('website.page.home.oric-member.update', ['cmsMemberId' => $home->id]) }}"
                                                       class="btn btn-success btn-primary">Update</a>
                                                    <a href="javascript:void(0)" class="btn btn-danger a-btn-custom"
                                                       onclick="deleteRecord(this, '{{ $home->id }}')">Disable</a>
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

        function deleteRecord(input, cmsMemberId) {
            let tr = $(input).parent().parent();
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willDelete) => {
                if (willDelete) {
                    axios.get(`/admin/website/pages/home/oric-member/delete/${cmsMemberId}`).then(function(response) {
                        swal(response.data.msg);
                        swal({
                            title: response.data.msg,
                            icon: "success",
                            closeOnClickOutside: false
                        }).then((btn) => {
                            tr.remove();
                        });
                    }).catch(function(error) {
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