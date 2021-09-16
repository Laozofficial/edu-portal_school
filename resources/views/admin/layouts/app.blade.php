<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="Easy Ace" />
    <meta name="robots" content="" />
    <meta name="description" content="Easy School Dashboard" />
    <meta name="format-detection" content="telephone=no">
    <title>Easy School </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{asset('admin/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/vendor/chartist/css/chartist.min.css')}}">
    <link href="{{asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('https://cdn.lineicons.com/2.0/LineIcons.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/css/vue-select.css')}}" rel="stylesheet"/>

    <!-- page plugins -->
    <link href="{{asset('admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('admin/vendor/toastr/css/toastr.min.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.css" integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/basic.css" integrity="sha512-+Vla3mZvC+lQdBu1SKhXLCbzoNCl0hQ8GtCK8+4gOJS/PN9TTn0AO6SxlpX8p+5Zoumf1vXFyMlhpQtVD5+eSw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
          body,html,p,h1,h2,h3,h4,h5,h6,span,li,ul,button,a,code,input,textarea, label{
                font-size: 0.875rem !important;
                /*font-weight: 700 !important;*/
            }
    </style>

</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        @include('admin.partials.nav')
        @include('admin.partials.sidenav')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" id="app">

            @yield('content')

        </div>
        <!--**********************************
            Content body end
        ***********************************-->
    </div>






      <!-- Required vendors -->
    <script src="{{asset('admin/plugins/js/jquery.js')}}"></script>
    <script src="{{asset('admin/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('admin/vendor/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/js/custom.min.js')}}"></script>
    <script src="{{asset('admin/js/deznav-init.js')}}"></script>
    <!-- Counter Up -->
    <script src="{{asset('admin/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin/vendor/jquery.counterup/jquery.counterup.min.js')}}"></script>
    <!-- Apex Chart -->
    <script src="{{asset('admin/vendor/apexchart/apexchart.js')}}"></script>
    <!-- Chart piety plugin files -->
    <script src="{{asset('admin/vendor/peity/jquery.peity.min.js')}}"></script>
    <!-- Dashboard 1 -->
    <script src="{{asset('admin/js/dashboard/dashboard-1.js')}}"></script>



    <!-- page custom plugins -->
    <script src="{{asset('admin/plugins/js/vue.js')}}"></script>
    <script src="{{asset('admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{asset('admin/vendor/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('admin/plugins/js/axios.js')}}"></script>
    <script src="{{asset('admin/plugins/js/vue-select2.js')}}"></script>
    <script src="{{asset('admin/plugins/js/app.js')}}"></script>
    <script src="{{asset('admin/plugins/js/check_token.js')}}"></script>
    <script src="{{asset('admin/plugins/js/vue-pagination.js')}}"></script>
<<<<<<< HEAD
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
=======
>>>>>>> 03b1670a8c7ca1bd3ab9d4910f2d84cc0c68baef

    <script>
        const base_url = "{{ url('/api/dashboard/admin/') }}";
        axios.defaults.baseURL = base_url;
        axios.defaults.headers.post['Content-Type'] = 'application/json';
     </script>

     <script src="{{asset('admin/plugins/js/validate_user_school.js')}}"></script>

    <!-- yield on all pages -->
    @yield('script')
</body>

</html>
