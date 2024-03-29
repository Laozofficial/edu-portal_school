<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="School Management system" />
    <meta name="format-detection" content="telephone=no">
    <title>Easy School - Authentication </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('easy_school/admin/images/favicon.png')}}">
    <link href="{{asset('easy_school/admin/css/style.css')}}" rel="stylesheet">

    <!-- page plugins -->
    <link href="{{asset('easy_school/admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('easy_school/admin/vendor/toastr/css/toastr.min.css')}}" />

    <style>
        .alert {
            font-size: 0.7rem !important;
            font-weight: bolder !important
        }

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


<body class="h-100">

    <div id="app">
        @yield('content')
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('easy_school/admin/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/js/custom.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/js/deznav-init.js')}}"></script>


    <!-- layout plugins -->
    <!-- page custom plugins -->
    <script src="{{asset('easy_school/admin/plugins/js/vue.js')}}"></script>
    <!--importing vue-->
    <script src="{{asset('easy_school/admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <!--importing sweet alert js-->
    <script src="{{asset('easy_school/admin/vendor/toastr/js/toastr.min.js')}}"></script>
    <!--import toastr-->
    <script src="{{asset('easy_school/admin/plugins/js/axios.js')}}"></script>
    <!--importing axios-->

    <script>
        const base_url = "{{ url('/api/dashboard/teacher/auth/') }}";
        axios.defaults.baseURL = base_url;
        //axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
        axios.defaults.headers.post['Content-Type'] = 'application/json'
    </script>

    <script src="{{asset('easy_school/admin/plugins/js/app.js')}}"></script>

    @yield('script')
</body>

</html>
