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
<html lang="en">

<head>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title> @isset($pageName)
                {{ $pageName }}
            @endisset - {{ $app_name[0] }}</title>

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
        <link href="{{ asset('plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

        <!-- PLUGINS CSS STYLE -->
        <link href="{{ asset('plugins/nprogress/nprogress.css') }}" rel="stylesheet" />

        <!--  CSS -->
        <link id="main-css-href" rel="stylesheet" href="{{ asset('css/style.css') }}" />




        <!-- FAVICON -->
        <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" />


        <script src="plugins/nprogress/nprogress.js"></script>
    </head>

</head>

<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-5 col-md-10 ">
                    <div class="card card-default mb-0">
                        <div class="card-header pb-0">
                            <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                                <img src="{{ asset('images/logo.png') }}" alt="Scholarship" width="100px">
                            </div>
                            <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                                <span class="brand-name text-dark"
                                    style="text-align: center;">{{ $app_name[0] }}</span>
                            </div>
                        </div>
                        <div class="card-body px-5 pb-5 pt-0">
                            <h4 class="text-dark text-center mb-5">Student Sign Up</h4>
                            <form action="{{ route('student-registration.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text"
                                            class="form-control input-lg @error('name') is-invalid @enderror"
                                            name="name" placeholder="Name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text"
                                            class="form-control input-lg @error('username') is-invalid @enderror"
                                            name="username" aria-describedby="emailHelp" placeholder="Username">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <input type="email"
                                            class="form-control input-lg @error('email') is-invalid @enderror"
                                            name="email" placeholder="Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <input type="password"
                                            class="form-control input-lg @error('password') is-invalid @enderror"
                                            name="password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">


                                        <button type="submit" class="btn btn-primary btn-pill mb-4">Sign Up</button>

                                        <p>Already have an account?
                                            <a class="text-blue" href="{{ route('login') }}">Sign in</a>
                                        </p>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<style>
    body {
        background-color: #f0f1f5;
    }
</style>
