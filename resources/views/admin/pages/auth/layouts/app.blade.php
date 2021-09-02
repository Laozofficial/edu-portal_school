<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta name="format-detection" content="telephone=no">
    <title>Easy School - Authentication </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/images/favicon.png')}}">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

     <!-- page plugins -->
    <link href="{{asset('admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('admin/vendor/toastr/css/toastr.min.css')}}"/>

</head>


<body class="h-100">

    @yield('content')


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('admin/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('admin/js/custom.min.js')}}"></script>
    <script src="{{asset('admin/js/deznav-init.js')}}"></script>


    <!-- layout plugins -->
    <!-- page custom plugins -->
    <script src="{{asset('admin/plugins/js/vue.js')}}"></script><!--importing vue-->
    <script src="{{asset('admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script><!--importing sweet alert js-->
    <script src="{{asset('admin/vendor/toastr/js/toastr.min.js')}}"></script><!--import toastr-->



    @yield('script')
</body>

</html>