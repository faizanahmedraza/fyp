<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>{{env('APP_NAME','JUW ORIC')}}</title>
    <link rel="shortcut icon" href="/assets/website/images/favicon.ico">
    <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="/assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/vendors/flags-icon/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    @stack('styles')
</head>

<body id="main-container" class="default semi-dark">
<div class="se-pre-con" style="display: none;">
    <div class="loader"></div>
</div>

@include('frontend.layouts.top_bar')

@include('frontend.layouts.side_bar')

@yield('content')

<!-- jQuery  -->
<script src="/assets/vendors/jquery/jquery-3.3.1.min.js"></script>
<script src="/assets/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="/assets/vendors/moment/moment.js"></script>
<script src="/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/js/app.js"></script>
@stack('scripts')
<script>
    window.laravel_echo_port = '{{env("LARAVEL_ECHO_PORT")}}';
</script>
<script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
<script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    console.clear();
    setInterval(function(){
        if($("div.alert-danger").length > 0 || $("div.alert-success").length > 0){
            setTimeout(function (){
                $("div.alert-danger").remove();
                $("div.alert-success").remove();
            },8000);
        }
    }, 1000);

    window.Echo.channel("student-name.{{\Illuminate\Support\Facades\Auth::id()}}")
        .listen('.studentFormStatus', (data) => {
            playAudio();
            $("#statusNotification").prev().append(
                `<span class="badge badge-default"> <span class="ring">
                                        </span><span class="ring-point">
                                        </span> </span>`
            );
            $("#statusNotification").prepend(
                `<li >
                                <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="/user/notification-detail/${data.data.id}">
                                    <div class="media">
                                        <img src="" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                        <div class="media-body">
                                             <p class="mb-0 text-primary"> ${data.data.get_user.first_name} ${data.data.get_user.last_name} ${data.data.message}</p>
                                            ${data.minutes}
                                        </div>
                                    </div>
                                </a>
                            </li>
                          `
            );
        });
    function playAudio() {
        var audio = new Audio('/assets/media/success.mp3');
        audio.play();
    }

</script>
</body>
</html>
