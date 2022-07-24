<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logo.png')}}">
    <title>Service Automotion</title>
    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('dist/css/style.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background-color:#F0F5F9;">


                <div class="col-lg-4 col-md-8 bg-white" style="border:1px solid transparant; border-radius: 20px;">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="{{asset('assets/images/logo.png')}}" height="80" width="60" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center" style="color:#EB6123;"><b>Welcome Back</b></h2>
                        <p class="text-center">Enter your email address and password to Sign in.</p>
                        <form class="mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="{{route('login')}}" method="post">
                                        {{ csrf_field() }}

                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                        <input type="password" name="password" class="form-control" placeholder="Password" >


                                        <button type="submit" class="btn btn-block" style="background-color:#EB6123; color:#fff;">Sign in</button>
                                    </form>
                                    <div class="col-lg-12 text-center mt-3">
                                    </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Don't have an account? <a href="#" class="text-danger">Sign Up</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}} "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}} "></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}} "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>
