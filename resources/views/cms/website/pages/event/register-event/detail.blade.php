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
                                    <h4 class="card-title">Register Event Details</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('website.page.register-event') }}"
                                       class="btn btn-primary float-right">← Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column p-0 pl-2 m-0">
                                <div class="d-flex">
                                    <span><strong>Event Name:</strong></span>
                                    <p class="pl-2">{{$registeredUsers->first()->getEvent->title}}</p>
                                </div>
                                <div class="d-flex">
                                    <span><strong>Event Scheduled On:</strong></span>
                                    <p class="pl-2">{{\Carbon\Carbon::parse($registeredUsers->first()->getEvent->schedule,'UTC')->isoFormat('lll')}}</p>
                                </div>
                            </div>
                            <table class="table table-borderless" data-tablesaw-mode="stack">
                                <thead>
                                <tr>
                                    <th scope="col">Participant Name</th>
                                    <th scope="col">Student Rollno#</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact Number</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($registeredUsers) > 0)
                                    @foreach($registeredUsers as $key => $val)
                                        <tr>
                                            <td>{{$val->getUser->full_name ?? ''}}</td>
                                            <td>{{$val->getUser->student_rollno ?? ''}}</td>
                                            <td>{{$val->getUser->email ?? ''}}</td>
                                            <td>{{$val->getUser->contact ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
@endsection