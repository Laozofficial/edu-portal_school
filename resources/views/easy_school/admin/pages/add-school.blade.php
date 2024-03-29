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
    <link href="{{asset('easy_school/admin/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('easy_school/admin/vendor/chartist/css/chartist.min.css')}}">
    <link href="{{asset('easy_school/admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('easy_school/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('https://cdn.lineicons.com/2.0/LineIcons.css')}}" rel="stylesheet">
    <link href="{{asset('easy_school/admin/plugins/css/vue-select.css')}}" rel="stylesheet"/>

    <!-- page plugins -->
    <link href="{{asset('easy_school/admin/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('easy_school/admin/vendor/toastr/css/toastr.min.css')}}"/>
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
        @include('easy_school.admin.partials.nav')

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
                <h5>Add Institution</h5>
            </div>
            <div class="card-body">
                  <div v-for="error in errors" class="mb-4 col-md-12 container">
                    <div class="alert alert-danger alert-dismissible fade show" v-show="errors_switch">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                            <strong>Error!</strong> @{{error}}
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                </div>

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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('easy_school/admin/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/vendor/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/js/custom.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/js/deznav-init.js')}}"></script>
    <!-- Counter Up -->
    <script src="{{asset('easy_school/admin/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/vendor/jquery.counterup/jquery.counterup.min.js')}}"></script>
    <!-- Apex Chart -->
    <script src="{{asset('easy_school/admin/vendor/apexchart/apexchart.js')}}"></script>
    <!-- Chart piety plugin files -->
    <script src="{{asset('easy_school/admin/vendor/peity/jquery.peity.min.js')}}"></script>
    <!-- Dashboard 1 -->
    <script src="{{asset('easy_school/admin/js/dashboard/dashboard-1.js')}}"></script>



    <!-- page custom plugins -->
    <script src="{{asset('easy_school/admin/plugins/js/vue.js')}}"></script>
    <script src="{{asset('easy_school/admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/vendor/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('easy_school/admin/plugins/js/axios.js')}}"></script>
    <script src="{{asset('easy_school/admin/plugins/js/vue-select2.js')}}"></script>
    <script src="{{asset('easy_school/admin/plugins/js/app.js')}}"></script>
    <script src="{{asset('easy_school/admin/plugins/js/check_token.js')}}"></script>

    <script>
        const base_url = "{{ url('/api/dashboard/admin/') }}";
        axios.defaults.baseURL = base_url;
        axios.defaults.headers.post['Content-Type'] = 'application/json';
     </script>

    <!-- yield on all pages -->
    <script src="{{asset('easy_school/admin/plugins/pages/add-school.js')}}"></script>

</body>

</html>

