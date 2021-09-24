<!doctype html>
<html lang="en">


<head>

        <meta charset="utf-8" />
        <title>Login | Edu Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="School Management System" name="description" />
        <meta content="Ellisoncorp" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('edu_portal/assets/images/favicon.ico')}}">

        <!-- preloader css -->
        <link rel="stylesheet" href="{{asset('edu_portal/assets/css/preloader.min.css')}}" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{asset('edu_portal/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('edu_portal/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('edu_portal/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>
</head>

<body>




           <div id="app">
               @yield('content')
           </div>


        <!-- latest jquery-->
          <!-- JAVASCRIPT -->
        <script src="{{asset('edu_portal/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('edu_portal/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('edu_portal/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('edu_portal/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('edu_portal/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('edu_portal/assets/libs/feather-icons/feather.min.js')}}"></script>
        <!-- pace js -->
        <script src="{{asset('edu_portal/assets/libs/pace-js/pace.min.js')}}"></script>
        <!-- password addon init -->
        <script src="{{asset('edu_Portal/assets/js/pages/pass-addon.init.js')}}"></script>
    <!-- Plugin used-->

    <script src="{{asset('easy_school/admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script><!--importing sweet alert js-->
    <script src="{{asset('edu_portal/assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/vendor/toastr/js/toastr.min.js')}}"></script><!--import toastr-->
      <!-- page custom plugins -->
    <script src="{{asset('easy_school/admin/plugins/js/vue.js')}}"></script><!--importing vue-->
    <script src="{{asset('easy_school/admin/plugins/js/axios.js')}}"></script><!--importing axios-->

    <script>
        const base_url = "{{ url('/api/dashboard/') }}";
        axios.defaults.baseURL = base_url;
        //axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
        axios.defaults.headers.post['Content-Type'] = 'application/json'
    </script>

    <script src="{{asset('easy_school/admin/plugins/js/app.js')}}"></script>

    @yield('script')
</body>

</html>
