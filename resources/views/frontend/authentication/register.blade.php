<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{env('APP_NAME')}}</title>

    <link rel="shortcut icon" href="/assets/website/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/admin/css/icons.css">
    <link rel="stylesheet" type="text/css" href="/assets/admin/css/style.css">

</head>

<body>
<div class="accountbg"></div>

<div class="wrapper-page">

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-5">
                <div class="card card-pages shadow-none mt-4">
                    <div class="card-body">
                        <div class="text-center mt-0 mb-3">
                            <a href="/register" class="logo logo-admin">
                                <img src="/assets/website/images/logo.png" class="mt-3" alt="" height="80"></a>
                            <p class="text-muted w-75 mx-auto mb-4 mt-4">Register your self to access portal.</p>
                        </div>

                        <form class="form-horizontal mt-4" action="/register" method="post">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('success')}}
                                </div>
                            @endif

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name <span
                                                class="required-class">*</span></label>
                                    <input type="text" class="form-control rounded" id="first_name"
                                           name="first_name" placeholder="Enter First Name"
                                           value="{{ old('first_name') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name <span
                                                class="required-class">*</span></label>
                                    <input type="text" class="form-control rounded" id="last_name"
                                           name="last_name" placeholder="Enter Last Name"
                                           value="{{ old('last_name') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="email">Email <span
                                                class="required-class">*</span></label>
                                    <input type="email" class="form-control rounded" id="email"
                                           name="email" placeholder="Enter Email"
                                           value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="password">Password <span class="required-class">*</span></label>
                                    <input type="password" class="form-control rounded" id="password"
                                           name="password" placeholder="Enter Password"
                                           value="{{ old('password') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="password">Password <span class="required-class">*</span></label>
                                    <input type="password" class="form-control rounded" id="password_confirmation"
                                           name="password_confirmation" placeholder="Re Enter Password"
                                           value="{{ old('password_confirmation') }}">
                                </div>
                            </div>

                            <div class="form-group text-center mt-3">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">
                                        Sign Up
                                    </button>
                                </div>
                            </div>
                            <div class="form-group text-center mt-4">
                                <div class="col-12">
                                    <div class="float-left">
                                        <a href="/login" class="text-muted"><i class="fa fa-lock mr-1"></i>
                                            Already have an account?</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery  -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script>
    setInterval(function () {
        $("div.alert-danger").remove();
        $("div.alert-success").remove();
    }, 5000);
</script>
</body>
</html>
