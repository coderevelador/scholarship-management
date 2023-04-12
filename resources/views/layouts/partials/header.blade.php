<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @php
        use App\Models\GeneralSettings;
        
        $app_name = GeneralSettings::pluck('app_name');
        
        $pageName = ucfirst(
            str_replace(
                '-',
                ' ',
                request()
                    ->route()
                    ->getName(),
            ),
        );
        
        $pageName = explode('.', $pageName)[0];
        
    @endphp
    <title>
        @isset($pageName)
            {{ $pageName }} -
            @endisset{{ $app_name[0] }}
        </title>

        <!-- theme meta -->
        <meta name="theme-name" content="Code" />

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        {{-- bootstrap --}}

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>


        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
        <link href="{{ asset('plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

        <!-- PLUGINS CSS STYLE -->
        <link href="{{ asset('plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="{{ asset('plugins/toaster/toastr.min.css" rel="stylesheet') }}" />

        <!-- MONO CSS -->
        <link id="main-css-href" rel="stylesheet" href="{{ asset('css/style.css') }}" />


        <!-- FAVICON -->
        <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" />
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

        {{-- Toaster --}}
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


        <script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>

        {{-- sweet alert --}}

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    </head>


    <body class="navbar-fixed sidebar-fixed" id="body">
        <script>
            NProgress.configure({
                showSpinner: true
            });
            NProgress.start();
        </script>


        <div id="toaster"></div>


        <!-- ====================================
            ——— WRAPPER
            ===================================== -->
        <div class="wrapper">
