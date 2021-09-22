<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from admin.pixelstrap.com/xolo/theme/login-video.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Sep 2021 15:43:11 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edu Portal Dashboard">
    <meta name="keywords" content="">
    <meta name="author" content="ellisoncorp">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Edu Portal - Authentication</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('edu_portal/assets/css/fontawesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('edu_portal/assets/css/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('edu_portal/assets/css/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('edu_portal/assets/css/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('edu_portal/assets/css/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link href="{{asset('easy_school/admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet"/>
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('edu_portal/assets/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('edu_portal/assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('edu_portal/assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('edu_portal/assets/css/responsive.css')}}">
</head>

<body>



      <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader"></div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="app">
        <div class="container-fluid p-0">
           @yield('content')
        </div>
    </div>


        <!-- latest jquery-->
    <script src="{{asset('edu_portal/assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('edu_portal/assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('edu_portal/assets/js/bootstrap/bootstrap.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('edu_portal/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('edu_portal/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('edu_portal/assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('edu_portal/assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('edu_portal/assets/js/login.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('edu_portal/assets/js/script.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->

    <script src="{{asset('easy_school/admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script><!--importing sweet alert js-->
    <script src="{{asset('edu_portal/assets/js/notify/bootstrap-notify.min.js')}}"></script>
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
<!-- Mirrored from admin.pixelstrap.com/xolo/theme/login-video.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Sep 2021 15:43:11 GMT -->

</html>
