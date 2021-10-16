<!doctype html>
<html lang="en">


<!-- Mirrored from minia.php.themesbrand.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Sep 2021 15:23:04 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Edu Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="School Management System" name="description" />
    <meta content="Ellisoncorp" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('edu_portal/assets/images/favicon.ico')}}">

    <!-- plugin css -->
    <link href="{{asset('edu_portal/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}"
        rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{asset('edu_portal/assets/css/preloader.min.css')}}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{asset('edu_portal/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('edu_portal/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('edu_portal/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{asset('https://cdn.lineicons.com/2.0/LineIcons.css')}}" rel="stylesheet">

    <link href="{{asset('easy_school/admin/plugins/css/vue-select.css')}}" rel="stylesheet" />

    <!-- page plugins -->
    <link href="{{asset('easy_school/admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('easy_school/admin/vendor/toastr/css/toastr.min.css')}}" />

    <style>
        body,
        html,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        span,
        li,
        ul,
        button,
        a,
        code,
        input,
        textarea,
        label {
            font-size: 0.875rem !important;
            /*font-weight: 700 !important;*/
        }
    </style>

</head>

<body>

    <div id="layout-wrapper">
        @include('edu_portal.Teacher.partials.header')

        @include('edu_portal.Teacher.partials.sidenav')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content" id="app">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            @include('edu_portal.Teacher.partials.footer')
        </div>

    </div>



    <!-- JAVASCRIPT -->
    <script src="{{asset('edu_portal/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('edu_portal/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('edu_portal/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('edu_portal/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('edu_portal/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('edu_portal/assets/libs/feather-icons/feather.min.js')}}"></script>
    <!-- pace js -->
    <script src="{{asset('edu_portal/assets/libs/pace-js/pace.min.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{asset('edu_portal/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Plugins js-->
    <script src="{{asset('edu_portal/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}">
    </script>
    <script
        src="{{asset('edu_portal/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}">
    </script>
    <!-- dashboard init -->
    <script src="{{asset('edu_portal/assets/js/pages/dashboard.init.js')}}"></script>

    <script src="{{asset('edu_portal/assets/js/app.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <!-- page custom plugins -->
    <script src="{{asset('easy_school/admin/plugins/js/vue.js')}}"></script>
    <script src="{{asset('easy_school/admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/vendor/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/plugins/js/axios.js')}}"></script>
    <script src="{{asset('easy_school/admin/plugins/js/vue-select2.js')}}"></script>
    <script src="{{asset('easy_school/admin/plugins/js/app.js')}}"></script>
    <script src="{{asset('easy_school/admin/plugins/js/check_token.js')}}"></script>
    <script src="{{asset('easy_school/admin/plugins/js/vue-pagination.js')}}"></script>

    <script>
        const base_url = "{{ url('/api/dashboard/teacher/') }}";
        axios.defaults.baseURL = base_url;
        axios.defaults.headers.post['Content-Type'] = 'application/json';
    </script>

    <!-- <script src="{{asset('easy_school/admin/plugins/js/validate_user_school.js')}}"></script> -->

    <!-- yield on all pages -->
    @yield('script')

</body>


</html>
