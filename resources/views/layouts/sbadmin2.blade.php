<!DOCTYPE html>
<html lang="en">

<head>
    <title>@if (isset($seo_title)) {{ $seo_title  }} @else {{ config('app.name') }} @endif</title>
    @if (isset($seo_description))<meta name="description" content="{{ $seo_description }}">@endif
    @if (isset($seo_key))<meta name="keywords" content="{{ $seo_key }}">@endif
    @if (isset($seo_image)) <meta property="og:image" content="{{ $seo_image }}" />@endif
    <meta name="author" content="{{ config('app.name') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom fonts for this template-->
{{--    <link href="/themes/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha256-UzFD2WYH2U1dQpKDjjZK72VtPeWP50NoJjd26rnAdUI=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/themes/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7Q58KBTYMP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-7Q58KBTYMP');
    </script>



</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    @if(isset($sidbar))
        @include('layouts.sbadmin2_sidebar')
    @endif

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                @include('layouts.sbadmin2_navbar')
            </nav>

            <!-- Content -->
            <div class="container-fluid">

                @yield('content')

            </div>

        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>{{ config('app.name') }} &copy; 2019</span>
                </div>
            </div>
        </footer>

    </div>

</div>



<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

{{--<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>--}}

<!-- Bootstrap core JavaScript-->
<script src="/themes/sbadmin2/vendor/jquery/jquery.min.js"></script>
<script src="/themes/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/themes/sbadmin2/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/themes/sbadmin2/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
{{--<script src="/themes/sbadmin2/vendor/chart.js/Chart.min.js"></script>--}}
<!-- Page level custom scripts -->
{{--<script src="/themes/sbadmin2/js/demo/chart-area-demo.js"></script>--}}
{{--<script src="/themes/sbadmin2/js/demo/chart-pie-demo.js"></script>--}}

<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha256-rByPlHULObEjJ6XQxW/flG2r+22R5dKiAoef+aXWfik=" crossorigin="anonymous" />
<script src="/js/script.js" defer></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(54914875, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/54914875" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


</body>

</html>
