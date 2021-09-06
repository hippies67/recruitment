<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Recruitment | Login</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo/favicon-16x16.png') }}">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/back/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="{{ asset('assets/back/css/lime.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back/css/custom.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <style>
        label.error {
            color: #f1556c;
            font-size: 13px;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.5;
            margin-top: 5px;
            padding: 0;
        }

        input.error {
            color: #f1556c;
            border: 1px solid #f1556c;
        }
    </style>
</head>

<body class="login-page err-500">
    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>
    <div class="container">
        <div class="login-container">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-9 lfh">
                    <div class="card login-box">
                        <div class="card-body">
                            <h5 class="card-title">Login</h5>
                            <form action="{{ route('login.authenticate') }}" method="POST" id="loginForm">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" id="exampleInputUsername1"
                                        aria-describedby="usernameHelp" placeholder="Enter Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password"
                                        id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="custom-control custom-checkbox form-group">
                                    <input type="checkbox" class="custom-control-input" id="exampleCheck1" name="remember">
                                    <label class="custom-control-label" for="exampleCheck1">Remember</label>
                                </div>
                                <button type="submit" class="btn btn-primary float-right m-l-xxs">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('sweetalert::alert')

    <!-- Javascripts -->
    <script src="{{ asset('assets/back/plugins/jquery/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/back/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/back/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/back/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/lime.min.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#loginForm").validate({
                rules: {
                    username:{
                        required: true,
                    },
                    password:{
                        required: true,
                    }
                },
                messages: {
                    username: {
                        required: "Silahkan isi kolom username",
                    },
                    password: {
                        required: "Silahkan isi kolom password",
                    },
                }
            });
        });
    </script>
</body>

</html>