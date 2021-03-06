@extends('cms.layouts.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/toggle-switch.css">
    <link rel="stylesheet" href="/assets/vendors/datatable/css/dataTables.bootstrap4.min.css">
    <style>
        .pointer-none {
            pointer-events: none;
        }
    </style>
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
                                    <h4 class="card-title">Blogs</h4>
                                </div>
                                @can('blog-create')
                                    <div class="col-md-6">
                                        <a href="{{ route('website.page.blog.add') }}"
                                           class="btn btn-primary float-right">Add +</a>
                                    </div>
                                @endcan
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
                                        <th data-priority="3">Author</th>
                                        <th data-priority="3">Title</th>
                                        <th data-priority="3">Description</th>
                                        <th>Active / In-Active</th>
                                        <th data-priority="1">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($resultSet) > 0)
                                        @foreach ($resultSet as $key => $blog)
                                            <tr class="{{$blog->is_disabled === 1 ? 'disabled-blur' : '' }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $blog->author }}</td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($blog->description, 20) }}
                                                </td>
                                                <td>
                                                    <label class="switch {{ $blog->is_disabled == 1 ? 'pointer-none' : '' }}">
                                                        <input type="checkbox" name="is_active" class="is_active"
                                                               value="1"
                                                               onchange="changeStatus(this, '{{ $blog->id }}','{{$blog->is_active}}')"
                                                                {{ empty($blog->is_active) ? 'checked' : '' }} {{ $blog->is_disabled == 1 ? 'disabled' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    @can('blog-update')
                                                        <a href="{{ route('website.page.blog.update', ['blogId' => $blog->id]) }}"
                                                           class="btn btn-success btn-primary m-1 {{$blog->is_disabled == 1 ? 'disabled-link' : 'enabled-link'}}">Update</a>
                                                    @endcan
                                                    @can('blog-delete')
                                                        <a href="javascript:void(0)" class="btn btn-danger a-btn-custom"
                                                           onclick="deleteRecord(this, '{{ $blog->id }}','{{$blog->is_disabled}}')">{{$blog->is_disabled == 1 ? 'Enable' : 'Disable'}}</a>
                                                    @endcan
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
    <script src="/assets/js/bootstrap4-toggle.min.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/sweetalert.min.js"></script>
    <script src="/assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $('.table').DataTable();
        });

        function changeStatus(input, blogId, is_block) {
            let status = is_block === '1' ? "inactive" : "active";
            swal({
                title: "Are you sure you want to " + status + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willDelete) => {
                if (willDelete) {
                    axios.get(`/admin/website/pages/blog/change-status/${blogId}`).then(function (response) {
                        swal(response.data.msg);
                        swal({
                            title: response.data.msg,
                            icon: "success",
                            closeOnClickOutside: false
                        }).then((successBtn) => {
                            if (successBtn) {
                                location.reload();
                                $(input).prop("checked", input.checked ? false : true);
                            }
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
            $(input).prop("checked", input.checked ? false : true);
        }

        function deleteRecord(input, blogId, is_disabled) {
            let status = is_disabled === '1' ? "enabled" : "disabled";
            swal({
                title: "Are you sure you want to " + status + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willDelete) => {
                if (willDelete) {
                    axios.get(`/admin/website/pages/blog/delete/${blogId}`).then(function (response) {
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