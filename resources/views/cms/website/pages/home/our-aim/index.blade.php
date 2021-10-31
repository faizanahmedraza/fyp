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
                                    <h4 class="card-title">Mission/Vision</h4>
                                </div>
                                @if (count($resultSet) == 0)
                                    <div class="col-md-6">
                                        <a href="{{ route('website.page.home.aim-intro.add') }}"
                                           class="btn btn-primary float-right">Add +</a>
                                    </div>
                                @endif
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
                                        <th data-priority="3">Vision</th>
                                        <th data-priority="3">Mission</th>
                                        <th data-priority="3">Values</th>
                                        <th data-priority="1">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($resultSet) > 0)
                                        @foreach ($resultSet as $key => $home)
                                            <tr class="{{$home->is_disabled === 1 ? 'disabled-blur' : '' }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($home->vision,10) }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($home->mission,10) }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($home->values,10) }}</td>
                                                <td>
                                                    <a href="{{ route('website.page.home.aim-intro.update', ['cmsIntroId' => $home->id]) }}"
                                                       class="btn btn-success btn-primary m-1 {{$home->is_disabled == 1 ? 'disabled-link' : 'enabled-link'}}">Update</a>
                                                    <a href="javascript:void(0)" class="btn btn-danger"
                                                       onclick="deleteRecord(this, '{{ $home->id }}','{{$home->is_disabled}}')">{{$home->is_disabled == 1 ? 'Enable' : 'Disable'}}</a>
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

        function deleteRecord(input, cmsIntroId, is_disabled) {
            let status = is_disabled === '1' ? "enabled" : "disabled";
            swal({
                title: "Are you sure you want to " + status + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willDelete) => {
                if (willDelete) {
                    axios.get(`/admin/website/pages/home/aim-intro/delete/${cmsIntroId}`).then(function (response) {
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