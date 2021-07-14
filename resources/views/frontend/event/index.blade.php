@extends('frontend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid site-width pl-xl-5 pt-3">
            <div class="row">
                @if(count($events) > 0)
                    @foreach($events as $key => $event)
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 mt-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-image business-card">
                                        <div class="background-image-maker"></div>
                                        <div class="holder-image">
                                            <img src="/assets/images/uploads/pages/event/{{$event->image}}"
                                                 alt="" class="img-fluid" style="min-height:230px!important; max-height: 230px!important;">
                                        </div>
                                        <div class="like"><i
                                                    class="ion ion-clock"></i> {{\Carbon\Carbon::parse($event->schedule,'UTC')->isoFormat('lll') }}
                                        </div>
                                    </div>
                                    <div class="card-body"
                                         style="min-height: 270px!important; max-height: 270px!important;">
                                        <h5 class="card-title mb-3 mt-2">{{$event->title}}</h5>
                                        <p class="card-text text-justify"
                                           style="min-height: 60px!important; max-height: 60px!important;">{{Str::limit($event->description,100)}}</p>
                                        <div class="row pt-2"  style="min-height: 76px!important; max-height: 76px!important;">
                                            @if($event->mode === 'Online')
                                                <div class="col-7">
                                                    <b><i class="ion ion-android-pin"></i>{{$event->mode}}</b>
                                                </div>
                                            @else
                                                <div class="col-7 text-justify">
                                                    <b><i class="ion ion-android-pin"></i> Location</b><br>
                                                    {{$event->location}}
                                                </div>
                                            @endif
                                            <div class="col-5 text-right text-success">
                                                <b><i class="ion ion-android-pin"></i>{{$event->getRegisteredEvents->count()}}
                                                    are Participated</b>
                                            </div>
                                        </div>
                                        <div class="pt-3">
                                            <button class="btn btn-secondary w-100">Register</button>
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
    <script></script>
@endpush