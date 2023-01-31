<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Scholarship Management</title>

    <!-- theme meta -->
    <meta name="theme-name" content="mono" />

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

    <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
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
