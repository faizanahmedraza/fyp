@extends('frontend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid site-width pl-xl-5 pt-3">
            @can('user-event-create')
                <div class="container px-0">
                    <div class="d-flex justify-content-between">
                        <h5 class="font-weight-bold">Events</h5>
                        <a href="/user/events/add" class="btn btn-success">Add Event</a>
                    </div>
                </div>
            @endcan
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                @if(count($events) > 0)
                    @foreach($events as $key => $event)
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 my-3">
                            <div class="card">
                                @can('user-event-update')
                                    <div class="card-header p-0">
                                        <a href="/user/events/{{$event->id}}/update"
                                           class="btn btn-primary btn-block rounded-0 rounded-top">Edit Event</a>
                                    </div>
                                @endcan
                                <div class="card-content">
                                    <div class="card-image business-card">
                                        <div class="background-image-maker"></div>
                                        <div class="holder-image">
                                            <img src="/assets/images/uploads/pages/event/{{$event->image}}"
                                                 alt="" class="img-fluid"
                                                 style="min-height:230px!important; max-height: 230px!important;">
                                        </div>
                                        <div class="like"><i
                                                    class="ion ion-clock"></i> {{\Carbon\Carbon::parse($event->schedule,'UTC')->isoFormat('lll') }}
                                        </div>
                                    </div>
                                    <div class="card-body"
                                         style="min-height: 270px!important; max-height: 270px!important;">
                                        <a href="/events/{{$event->slug}}/gallery" class="text-decoration-none"><h5 class="card-title text-truncate">{{$event->title}}</h5></a>
                                        <p class="card-text text-justify"
                                           style="min-height: 60px!important; max-height: 60px!important;">{{Str::limit($event->description,70)}}</p>
                                        <div class="row pt-2"
                                             style="min-height: 76px!important; max-height: 76px!important;">
                                            @if($event->mode === 'Online')
                                                <div class="col-4">
                                                    <b><i class="ion ion-android-pin"></i>{{$event->mode}}</b>
                                                </div>
                                                <div class="col-8 text-right text-success">
                                                    <b><i class="ion ion-android-pin"></i>Participated: {{$event->getRegisteredEvents->count()}}</b>
                                                </div>
                                            @else
                                                <div class="col-6 text-justify pr-0 m-0">
                                                    <b><i class="ion ion-android-pin"></i> Location</b><br>
                                                    {{$event->location}}
                                                </div>
                                                <div class="col-6 text-right text-success">
                                                    <b><i class="ion ion-android-pin"></i>Participated: {{$event->getRegisteredEvents->count()}}</b>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="pt-3">
                                            @if(!empty($event->getRegisteredEvents) &&
                                            in_array(Auth::id(),$event->getRegisteredEvents->pluck('user_id')->toArray()))
                                                @php
                                                    $register = 'registered';
                                                @endphp
                                            @else
                                                @php
                                                    $register = 'un-registered';
                                                @endphp
                                            @endif
                                            <button class="btn btn-secondary w-100"
                                                    onclick="onRegister('{{$event->id}}','{{$register}}')">{{ ucwords(str_replace('-',' ',$register)) }}
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
        function onRegister(eventId, status) {
            let getStatus = status === 'un-registered' ? "register" : "unregister";
            swal({
                title: "Are you sure you want to " + getStatus + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willDelete) => {
                if (willDelete) {
                    axios.get(`/user/register-event/${eventId}`).then(function (response) {
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