<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>{{ env('APP_NAME','ORIC') }}</title>

    <!-- Fav Icon -->
    <link rel="icon" href="/assets/website/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=EB+Garamond:400,400i,500,500i,600,600i,700,700i,800,800i&amp;display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="/assets/website/css/font-awesome-all.css" rel="stylesheet">
    <link href="/assets/website/css/flaticon.css" rel="stylesheet">
    <link href="/assets/website/css/owl.css" rel="stylesheet">
    <link href="/assets/website/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/website/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="/assets/website/css/animate.css" rel="stylesheet">
    <link href="/assets/website/css/style.css" rel="stylesheet">
    <link href="/assets/website/css/responsive.css" rel="stylesheet">
    @stack('styles')
</head>


<!-- page wrapper -->
<body class="boxed_wrapper">

<!-- preloader -->
<div class="preloader"></div>
<!-- preloader -->

<!-- main header -->
@include('website.layouts.header')
<!-- main-header end -->

<!-- Mobile Menu  -->
@include('website.layouts.mobile-menu')
<!-- End Mobile Menu -->

<!-- intro-section -->
@yield('content')
<!-- intro-section end -->

<!-- main-footer -->
@include('website.layouts.footer')
<!-- main-footer end -->

<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-arrow-up"></span>
</button>


<!-- jequery plugins -->
<script src="/assets/website/js/jquery.js"></script>
<script src="/assets/website/js/popper.min.js"></script>
<script src="/assets/website/js/bootstrap.min.js"></script>
<script src="/assets/website/js/owl.js"></script>
<script src="/assets/website/js/wow.js"></script>
<script src="/assets/website/js/validation.js"></script>
<script src="/assets/website/js/jquery.fancybox.js"></script>
<script src="/assets/website/js/appear.js"></script>
<script src="/assets/website/js/scrollbar.js"></script>
<script src="/assets/website/js/bxslider.js"></script>
<script src="/assets/website/js/jquery.countTo.js"></script>

<!-- main-js -->
<script src="/assets/website/js/script.js"></script><!--Start of Tawk.to Script-->
{{--<script type="text/javascript">--}}
{{--    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();--}}
{{--    (function(){--}}
{{--        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];--}}
{{--        s1.async=true;--}}
{{--        s1.src='https://embed.tawk.to/6147304c25797d7a89ffbccc/1ffv19b39';--}}
{{--        s1.charset='UTF-8';--}}
{{--        s1.setAttribute('crossorigin','*');--}}
{{--        s0.parentNode.insertBefore(s1,s0);--}}
{{--    })();--}}
{{--</script>--}}
<!--End of Tawk.to Script-->
@stack('scripts')
</body><!-- End of .page_wrapper -->
</html>
