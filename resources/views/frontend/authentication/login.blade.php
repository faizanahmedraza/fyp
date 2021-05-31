<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Dalda</title>

    <link rel="shortcut icon" href="/assets/images/favicon.ico">
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
                            <a href="/login" class="logo logo-admin">
                                <img src="/assets/images/logo-sm.png" class="mt-3" alt="" height="80"></a>
                            <p class="text-muted w-75 mx-auto mb-4 mt-4">Enter your email address and password to access portal.</p>
                        </div>

                        <form class="form-horizontal mt-4" action="/login" method="post">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('error')}}
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="col-12">
                                    <label for="email">Email <span class="required-class">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-12">
                                    <label for="password">Password <span class="required-class">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-12">
                                    <div class="checkbox checkbox-primary">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me" value="true">
                                            <label class="custom-control-label" for="remember_me"> Remember me</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center mt-3">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
                            <div class="form-group text-center mt-4">
                                <div class="col-12">
                                    <div class="float-left">
                                        <a href="/forgot-password" class="text-muted"><i class="fa fa-lock mr-1"></i> Forgot your password?</a>
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
    setInterval(function(){
        $("div.alert-danger").remove();
        $("div.alert-success").remove();
    }, 5000);
</script>
</body>
</html>
