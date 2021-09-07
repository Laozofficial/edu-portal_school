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
    <style>
        label{
            font-weight: bolder !important
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

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" id="app">

    <div class="container " v-show="content">
        <div class="row page-titles mx-0">
            <div class="col-sm-12 p-md-0">
                <div class="welcome-text">
                    <h4 class="">Add Institution</h4>
                </div>
            </div>

        </div>

        <div class="card w-75">
            <div class="card-header">
                Add Institution
                @{{errors}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                         <label for="country">Select Institution Country <span class="text-danger">*</span></label>
                         <v-select :options="countries" label="name" v-model="selected_country" :reduce="countries => countries.id" id="country"></v-select>

                         <label for="language" class="mt-3">Select Institution Language <span class="text-danger">*</span></label>
                         <v-select :options="languages" label="name" v-model="selected_language" :reduce="languages => languages.id" id="language"></v-select>

                         <label for="name" class="mt-3">Institution Name <span class="text-danger">*</span></label>
                         <input type="text" class="form-control input-default form-control-sm" placeholder="Name" id="name" v-model="name">

                         <label for="address" class="mt-3">Institution Address <span class="text-danger">*</span></label>
                         <input type="text" class="form-control input-default form-control-sm" placeholder="Address" id="address" v-model="address">

                          <label for="email" class="mt-3">Institution Email <span class="text-danger">*</span></label>
                         <input type="email" class="form-control input-default form-control-sm" placeholder="Email Address" id="email" v-model="email">

                          <label for="phone" class="mt-3">Institution Phone Number <span class="text-danger">*</span></label>
                         <input type="number" class="form-control input-default form-control-sm" placeholder="Phone Number" id="phone" v-model="phone">

                         <button class="btn btn-primary btn-sm mt-3 btn-block" @click="save_institution">
                             <i class="fa fa-paper-plane"></i> Submit
                         </button>
                    </div>
                    <div class="col-md-6">
                        <label for="currency">Select Institution Currency <span class="text-danger">*</span></label>
                         <v-select :options="currencies" label="currency_name" v-model="selected_currency" :reduce="currencies => currencies.id" id="currency"></v-select>

                         <label for="states" class="mt-3">Institution State Of Origin <span class="text-danger">*</span></label>
                         <v-select :options="states" label="name" v-model="selected_state" :reduce="states => states.id" od="states"></v-select>

                          <label for="prefix" class="mt-3">Institution Name Prefix </label>
                         <input type="text" class="form-control input-default form-control-sm" placeholder="Eg STH" id="prefix" v-model="prefix">

                          <label for="website" class="mt-3">Institution Website </label>
                         <input type="text" class="form-control input-default form-control-sm" placeholder="https://www.something.com" id="website" v-model="website">

                         <label class="mt-3">Upload Institution Logo <span class="text-danger">*</span></label>
                         <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" @change="onLogoChanged">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>


                        <label class="mt-3">Upload Institution Signature</label>
                         <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" @change="onSignatureChanged">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>


        </div>
        <!--**********************************
            Content body end
        ***********************************-->
    </div>









      <!-- Required vendors -->
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

    <script>
        const base_url = "{{ url('/api/dashboard/admin/') }}";
        axios.defaults.baseURL = base_url;
        axios.defaults.headers.post['Content-Type'] = 'application/json';
     </script>

    <!-- yield on all pages -->
    <script src="{{asset('admin/plugins/pages/add-school.js')}}"></script>

</body>

</html>

