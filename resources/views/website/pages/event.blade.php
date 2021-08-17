@extends('website.layouts.master')

@section('content')
    <!--Page Title-->
    <section class="page-title banner" style="background-image: url(/assets/website/images/background/page-title.jpg);">
        <div id="particles-js" class="particles-pattern">
            <canvas class="particles-js-canvas-el"></canvas>
        </div>
        <div class="container">
            <div class="content-box">
                <h1>Event</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li>Events List</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- blog-page-section -->
    <section class="blog-page-section">
        <div class="container">
            <div class="row">
                @foreach($events as $key => $event)
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-holder">
                                    <figure class="image"><a href="/news/detail/{{$event->slug}}"><img
                                                    src="/assets/images/uploads/pages/event/{{$event->image}}"
                                                    alt=""></a></figure>
                                    <div class="date-box">
                                        <span>{{\Carbon\Carbon::parse($event->created_at,'UTC')->isoFormat('Do') }}</span>{{ Str::upper(\Carbon\Carbon::parse($event->created_at,'UTC')->isoFormat('MMMM')) }}
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <ul class="info-box clearfix">
                                        <li class="d-flex justify-content-between">
                                            <a href="#">{{ $event->title ?? '' }}</a>
                                            @auth
                                                @if(in_array(Arr::first(Auth::user()->getRoleNames()),['student','researcher','faculty','focal-person','oric-member']))
                                                    @php
                                                        $register = 'un-registered';
                                                    @endphp
                                                    @if(!empty($event->getRegisteredEvents) &&
                                                        in_array(Auth::id(),$event->getRegisteredEvents->pluck('user_id')->toArray()))
                                                        @php
                                                            $register = 'registered';
                                                        @endphp
                                                    @endif
                                                    <button class="btn btn-secondary btn-sm"
                                                            onclick="onRegister('{{$event->id}}','{{$register}}')">{{ ucwords(str_replace('-',' ',$register)) }}
                                                    </button>
                                                @endif
                                            @endauth
                                            @guest
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                        data-toggle="modal" data-target="#guestModal">
                                                    Register For Event
                                                </button>
                                            @endguest
                                        </li>
                                    </ul>
                                    <h2>
                                        <a href="/events/{{$event->slug}}/gallery">{{ Str::limit($event->description,20) ?? '' }}</a>
                                    </h2>
                                    <div class="link-btn"><a href="/events/{{$event->slug}}/gallery"><i
                                                    class="flaticon-right-arrow"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Guest Modal -->
                    <div class="modal fade" id="guestModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle1">{{$event->title}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form">
                                    <div class="modal-body">
                                        <input type="hidden" name="event_id" value="{{$event->id}}">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="your_name">Your Full Name <span class="required-modal-class">*</span></label>
                                                <input type="text" class="form-control rounded" name="name"
                                                       id="your_name"
                                                       placeholder="Your Full Name" maxlength="55" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="your_email">Email <span class="required-modal-class">*</span></label>
                                                <input type="email" class="form-control" name="email" id="your_email"
                                                       placeholder="Your Email" maxlength="100" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Guest Modal -->
                @endforeach
            </div>
        </div>
    </section>
    <!-- blog-section end -->
@endsection


@push('scripts')
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/sweetalert.min.js"></script>
    <script>
        function onRegister(eventId, status, guest = '') {
            let getStatus = status === 'un-registered' ? "register" : "unregister";
            swal({
                title: "Are you sure you want to " + getStatus + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willGo) => {
                $('#guestModal').modal('hide');
                if (willGo) {
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

        const form = document.querySelector('#form');

        if (form) {
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                const eventId = $("[name='event_id']").val().trim();
                const guestName = $("[name='name']").val().trim();
                const guestEmail = $("[name='email']").val().trim();
                if(eventId === '' || guestName === '' || guestEmail === '')
                {
                    $(".required-modal-class").addClass('text-danger');
                    return false;
                }
                axios.post(`/guest/register-event`, {
                    eventId,
                    guestName,
                    guestEmail,
                }).then(function (response) {
                    swal({
                        title: response.data.msg,
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((successBtn) => {
                        if (successBtn) {
                            $("#your_name,#your_email").val('');
                            $("#guestModal").removeClass("fade").modal("hide");
                            window.history.pushState({},document.title,'/events')
                        }
                    });
                }).catch(error => {
                    swal({
                        title: error.data.message,
                        icon: "danger",
                        closeOnClickOutside: false
                    })
                });
            });
        }

    </script>
@endpush