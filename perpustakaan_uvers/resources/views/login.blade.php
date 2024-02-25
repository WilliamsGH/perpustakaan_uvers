<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5" />
    <meta name="author" content="AdminKit" />
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="shortcut icon" href="{{ Storage::url('img/icons/icon-48x48.png') }}" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Login</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <!-- Content -->
        <div class="container-fluid vh-100 overflow-hidden">
            <div class="row md-d-flex align-items-md-center">
                <div class="d-none d-md-block col-md-6 col-lg-6 px-0">
                    <img src="{{ Storage::url('img/contents/login.png')}}" alt="" class="vh-100" />
                </div>
                <div class="col-md-4 offset-md-1 form-box px-5">
                    <h1 class="fw-bold mb-4 text-center text-md-start">
                        Masuk dengan akun Administrator
                    </h1>
                    <form action="{{url('/login')}}" method="post" class="d-flex flex-column">
                        @csrf
                        <div class="d-flex">
                            <div class="login-icons-box form-control text-center px-0">
                                <img src="{{ Storage::url('img/icons/person-fill.svg') }}" alt="" class="d-flex login-icons" />
                            </div>
                            <input type="text" class="form-control" name="username" placeholder="Username" required/>
                        </div>
                        <div class="d-flex mt-3">
                            <div class="login-icons-box form-control text-center px-0">
                                <img src="{{ Storage::url('img/icons/password-lock.svg')}}" alt="" class="d-flex login-icons" />
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required/>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{$errors->first('message') }}
                            </div>
                        @endif
                        <input type="submit" class="form-control" value="Masuk" />
                    </form>
                </div>
            </div>
        </div>
        <!-- End Content -->
    </div>

    <!-- Script -->
    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- End Script -->
</body>

</html>
