<!DOCTYPE html>
<html lang="id" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') | SIJADWALBOJONGSARI</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logos/logo-purbalingga.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        console.log("%cPeringatan: Jangan melakukan hal yang nakal!", "color: red; font-size: 30px; font-weight: bold;");
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body id="bg">
    <div class="preloader">
        <img src="https://cdn.dribbble.com/users/1046956/screenshots/4616830/runner.gif" alt="loader"
            class="lds-ripple img-fluid" style="width: 400px!important; margin-top: -150px!important;" />
    </div>
    <div id="main-wrapper">
        @include('layouts.components.aside')
        <div class="page-wrapper">
            @include('layouts.components.topbar')
            @include('layouts.components.leftsidebar')
            <div class="body-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <script>
                function handleColorTheme(e) {
                    $("html").attr("data-color-theme", e);
                    $(e).prop("checked", !0);
                }
            </script>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/app.init.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>

    <script src="{{ asset('vendor/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('vendor/apexcharts/dist/apexcharts.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
