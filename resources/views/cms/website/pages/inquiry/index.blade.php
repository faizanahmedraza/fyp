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
                                    <h4 class="card-title">Inquires List</h4>
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
                                        <th data-priority="3" style="max-width: 100px;">Email</th>
                                        <th data-priority="3" style="max-width: 150px;">Subject</th>
                                        <th data-priority="1">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($inquires) > 0)
                                        @foreach ($inquires as $key => $val)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $val->name }}</td>
                                                <td>{{ $val->email }}</td>
                                                <td>{{ \Illuminate\Support\Str::words($val->subject, 10) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('website.page.inquiries.detail', ['inquiryId' => $val->id]) }}"
                                                       class="btn btn-success btn-primary">Detail</a>
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