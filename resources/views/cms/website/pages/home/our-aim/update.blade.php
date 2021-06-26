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
                                    <h4 class="card-title">Update Mission/Vision</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('website.page.home.aim-intro') }}" class="btn btn-primary float-right">← Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form method="POST" action="{{ route('website.page.home.aim-intro.update.data',['cmsIntroId' => $updateIntro->id]) }}"
                                              enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            @if ($errors->any())
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>Error!</strong>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label> Vision <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                            <textarea name="vision" id="vision" class="form-control"
                                                      placeholder="Enter Description" rows="2">{{ old('vision',$updateIntro->vision) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label> Mission <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                            <textarea name="mission" id="mission" class="form-control"
                                                      placeholder="Enter Description" rows="2">{{ old('mission',$updateIntro->mission) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label> Values <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                            <textarea name="values" id="values" class="form-control"
                                                      placeholder="Enter Description" rows="2">{{ old('values',$updateIntro->values) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-5">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light float-right">
                                                    Save
                                                </button>
                                            </div>
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