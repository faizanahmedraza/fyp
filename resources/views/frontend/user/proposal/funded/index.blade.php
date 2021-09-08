@extends('frontend.layouts.master')

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
                                    <h4 class="card-title">Funded Proposals</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/user/funded-proposals/add" class="btn btn-primary float-right">Add
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
                                        <th>Title</th>
                                        <th>Student Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($proposals) > 0)
                                        @foreach($proposals as $key => $proposal)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $proposal->title }}</td>
                                                <td>{{ $proposal->getUser->full_name }}</td>
                                                <td>
                                                    <button href="javascript:void(0);"
                                                            class="btn btn-dark btn-sm"
                                                            disabled>{{ ucfirst($proposal->status) }}</button>
                                                </td>
                                                <td>
                                                    <a href="/user/funded-proposals/{{$proposal->id}}/detail"
                                                       class="btn btn-info btn-sm">Detail</a>
                                                    @if($proposal->status === 'pending')
                                                            <a href="/user/funded-proposals/{{$proposal->id}}/update"
                                                               class="btn btn-info btn-sm">Update</a>
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
    <script src="/assets/vendors/datatable/js/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $('.table').DataTable();
        });
    </script>
@endpush
