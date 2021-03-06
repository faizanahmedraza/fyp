@extends('frontend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid site-width pl-xl-5 pt-3">
            <div class="row">
                @if(count($internships) > 0)
                    @foreach($internships as $key => $val)
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 mt-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-image business-card">
                                        <div class="background-image-maker"></div>
                                        <div class="holder-image">
                                            <img src="/assets/images/uploads/pages/internship/{{$val->image}}"
                                                 alt="" class="img-fluid"
                                                 style="min-height:230px!important; max-height: 230px!important;">
                                        </div>
                                        <div class="like"><i
                                                    class="ion ion-clock"></i>
                                            @php
                                                $date = explode(' - ',$val->duration);
                                                $startDate = \Carbon\Carbon::parse(trim($date[0]),'UTC')->isoFormat('ll');
                                                $endDate = \Carbon\Carbon::parse(trim($date[1]),'UTC')->isoFormat('ll');
                                            @endphp

                                            {{ $startDate .' to '. $endDate}}
                                        </div>
                                    </div>
                                    <div class="card-body"
                                         style="min-height: 270px!important; max-height: 270px!important;">
                                        <a href="/internships/{{$val->slug}}/internship-detail" class="d-flex text-decoration-none"><h5 class="card-title text-truncate" style="max-width: 160px;">{{$val->title}}</h5> <span class="ml-1" style="font-size: 13px;">({{ $val->paid == 1 ? 'Paid' : 'UnPaid' }})</span></a>
                                        <p class="card-text text-justify"
                                           style="min-height: 60px!important; max-height: 60px!important;">{{Str::limit($val->description,70)}}</p>
                                        <div class="row pt-2"
                                             style="min-height: 76px!important; max-height: 76px!important;">
                                            @if($val->mode === 'Online')
                                                <div class="col-4">
                                                    <b><i class="ion ion-android-pin"></i>{{ $val->company }}</b> <span style="font-size: 13px;">({{$val->mode}})</span>
                                                </div>
                                                <div class="col-8 text-right text-success">
                                                    <b><i class="ion ion-android-pin"></i>Applied: {{$val->getRegisteredInterns->count()}}</b>
                                                </div>
                                            @else
                                                <div class="col-7">
                                                    <b><i class="ion ion-android-pin"></i>{{ $val->company }}</b> <span style="font-size: 13px;">(Physical)</span><br>
                                                    {{$val->location}}
                                                </div>
                                                <div class="col-5 text-right text-success">
                                                    <b><i class="ion ion-android-pin"></i>Applied: {{$val->getRegisteredInterns->count()}}</b>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="pt-3">
                                            @if(!empty($val->getRegisteredInterns) &&
                                            in_array(Auth::id(),$val->getRegisteredInterns->pluck('user_id')->toArray()))
                                                @php
                                                    $register = 'registered';
                                                @endphp
                                            @else
                                                @php
                                                    $register = 'un-registered';
                                                @endphp
                                            @endif
                                            <button class="btn btn-secondary w-100"
                                                    onclick="onRegister('{{$val->id}}','{{$register}}')">{{ ucwords(str_replace('-',' ',$register)) }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/sweetalert.min.js"></script>
    <script>
        function onRegister(internId, status) {
            let getStatus = status === 'un-registered' ? "register" : "unregister";
            swal({
                title: "Are you sure you want to " + getStatus + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willDelete) => {
                if (willDelete) {
                    axios.get(`/user/register-intern/${internId}`).then(function (response) {
                        swal({
                            title: response.data.msg,
                            icon: "success",
                            closeOnClickOutside: false
                        }).then((successBtn) => {
                            if (successBtn) {
                                location.reload();
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
        }
    </script>
@endpush