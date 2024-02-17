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
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />


    <title>{{ $title ?? 'Perpustakaan UVERS' }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @yield('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <div class="sidebar-brand" href="#">
                    <span class="align-middle">
                        <img src="{{ Storage::url('img/icons/logo.svg')}}" width="50" alt="" />
                        Library
                    </span>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-item {{ @$title=='Dashboard' ? 'active' : ''}}">
                        <a class="sidebar-link" href="{{ url('/dashboard') }}">
                            <img src="{{Storage::url('img/icons/dashboard-icon.svg')}}" alt="" />
                            <span class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item  {{ @$title=='Bibliography' ? 'active' : ''}}">
                        <a class="sidebar-link" href="{{ url('/bibliography') }}">
                            <img src="{{Storage::url('img/icons/bibliography-icon.svg')}}" alt="" />
                            <span class="align-middle">Bibliography</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ @$title=='Riwayat Peminjaman' ? 'active' : ''}}">
                        <a class="sidebar-link" href="{{ url('/borrowing_history') }}">
                            <img src="{{Storage::url('img/icons/riwayat-icon.svg')}}" alt="" />
                            <span class="align-middle">Riwayat Peminjaman</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ @$title=='Anggota' ? 'active' : ''}}">
                        <a class="sidebar-link" href="{{ url('/member') }}">
                            <img src="{{Storage::url('img/icons/anggota-icon.svg')}}" alt="" />
                            <span class="align-middle">Anggota</span>
                        </a>
                    </li>
                    <li class="sidebar-item logout">
                        <a class="sidebar-link" href="{{ url('/logout') }}">
                            <img src="{{Storage::url('img/icons/logout-icon.svg')}}" alt="" />
                            <span class="align-middle">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <img src="{{Storage::url('img/icons/double-arrow-left.svg')}}" alt="" class="" />
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    {{-- <span class="indicator">4</span> --}}
                                </div>
                            </a>
                            {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">4 New Notifications</div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">
                                                    Restart server 12 to complete the update.
                                                </div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">
                                                    Aliquam ex eros, imperdiet vulputate hendrerit et.
                                                </div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">
                                                    Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li> --}}
                        <li>
                            <div class="nav-link d-none d-sm-inline-block">
                                <img src="{{ Storage::url('img/avatars/default.png')}}" class="avatar img-fluid rounded-pill me-1"
                                    alt="Your Name" />
                                <span class="text-dark">{{$user->name}}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Content -->
            @yield('content')
            <!-- End Content -->
        </div>
    </div>
    

    <!-- Script -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('js')
    <!-- End Script -->
</body>

</html>