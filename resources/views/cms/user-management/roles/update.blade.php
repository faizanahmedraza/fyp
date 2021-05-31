@extends('cms.layouts.master')

@section('content')
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Update Role</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/admin/manage-roles" class="btn btn-primary float-right">← Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form action="/admin/update-role/{{$role->id}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            @if($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="name">Role Name</label>
                                                    <input type="text" class="form-control rounded" id="name" name="role_name" placeholder="Enter Role Name" value="{{ old('role_name',$role->name) }}">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <label>Permissions <span class="required-class">*</span></label>
                                                <div class="float-right">
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input permission" id="select-all">
                                                        <label class="custom-control-label checkbox-primary outline"
                                                               for="select-all">Select All</label>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-row">
                                                    @foreach($permissions as $key => $val)
                                                        <div class="form-group col-md-2">
                                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                                <input type="checkbox"
                                                                       class="custom-control-input permission"
                                                                       id="permissions{{$key}}"
                                                                       name="permissions[{{$key}}]"
                                                                       value="{{ $val->id }}" {{ in_array($val->id, $rolePermissions) ? 'checked' : '' }}>
                                                                <label class="custom-control-label checkbox-primary outline"
                                                                       for="permissions{{$key}}">{{ $val->name }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
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
    <script>
        $("#select-all").click(function () {
            if($(this).is(":checked")){
                $(".permission").prop("checked",true);
            } else {
                $(".permission").prop("checked",false);
            }
        });
    </script>
@endpush
