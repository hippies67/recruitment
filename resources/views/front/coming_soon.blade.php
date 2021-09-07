<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Recruitment | Tahungoding</title>
	<link rel="shortcut icon" href="{{ asset('assets/back/images/tahu.png') }}" type="image/x-icon">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/back/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="{{ asset('assets/back/css/lime.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/back/css/custom.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    <style>
        #bg-error {
            background-color: #F4CF00 !important;
            background: transparent;
            background: -webkit-linear-gradient(top, transparent, rgba(0, 0, 0, 0.5));
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.5));
        }
    </style>
</head>

<body class="error-page coming-soon" id="bg-error">
    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>
    <div class="container">
        <div class="error-container">
            <div class="error-info">
                <h1 style="color: #ffffff !important;">Maintenance</h1>
                <p style="color: #ffffff !important;">Website sedang dalam perbaikan.<br>Mohon maaf atas ketidaknyamanan
                    nya.</p>
            </div>
            <div class="error-image"></div>
        </div>
    </div>



    <!-- Javascripts -->
    <script src="{{ asset('assets/back/plugins/jquery/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/back/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/back/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/back/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/lime.min.js') }}"></script>
</body>

</html>