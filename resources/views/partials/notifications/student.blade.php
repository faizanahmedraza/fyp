@foreach($student_notifications as $key => $val)
    <li>
        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="/student/notification-detail/{{$val->id}}">
            <div class="media">
                <img src="" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                <div class="media-body">
                    <p class="mb-0 text-primary">{{ $val->getUser->full_name }} {{ $val->message }}</p>
                    {{ Carbon\Carbon::createFromTimestamp(strtotime($val->created_at))->diffForHumans() }}
                </div>
            </div>
        </a>
    </li>
@endforeach