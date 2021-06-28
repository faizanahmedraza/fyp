@extends('cms.layouts.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/toggle-switch.css">
    <link rel="stylesheet" href="/assets/vendors/datatable/css/dataTables.bootstrap4.min.css">
    <style>
        .icon-close {
            font-size: 30px;
            font-weight: 800;
            background: transparent;
            box-shadow: none;
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
                                    <h4 class="card-title">Gallery</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('website.page.event.gallery.add') }}" class="btn btn-primary float-right">Add
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
                                        <th data-priority="1">#ID</th>
                                        <th data-priority="3">Event Name</th>
                                        <th>Image</th>
                                        <th data-priority="1">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($resultSet) > 0)
                                        @foreach ($resultSet as $key => $gallery)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $gallery->getEvent->title}}</td>
                                                <td><a href="javascript:void(0);" class="btn btn-primary cstModal" data-img="{{$gallery->image}}" data-toggle="modal" data-target="#viewImage">View Image</a></td>
                                                <td>
                                                    <a href="{{ route('website.page.event.gallery.update', ['galleryId' => $gallery->id]) }}"
                                                       class="btn btn-success btn-primary">Update</a>
                                                    <a href="javascript:void(0)" class="btn btn-danger a-btn-custom"
                                                       onclick="deleteRecord(this, '{{ $gallery->id }}')">Delete</a>
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


    <!--Image View Model-->
    <div class="modal fade" id="viewImage" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: -32px; top: -32px;">
                    <i class="icon-close" style="color:red;"></i>
                </button>
                <img class="imgClass" src="" alt="gallery-image"/>
            </div>
        </div>
    </div>
    <!--End Image View Model-->
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
            $(".cstModal").on("click",function () {
                let imgName = $(this).data('img');
                $(".imgClass").attr('src','/assets/images/uploads/pages/event/gallery/'+imgName);
            });
        });w

        function deleteRecord(input, galleryId) {
            let tr = $(input).parent().parent();
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willDelete) => {
                if (willDelete) {
                    axios.get(`/admin/website/pages/event/delete/${galleryId}`).then(function (response) {
                        swal(response.data.msg);
                        swal({
                            title: response.data.msg,
                            icon: "success",
                            closeOnClickOutside: false
                        }).then((btn) => {
                            tr.remove();
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