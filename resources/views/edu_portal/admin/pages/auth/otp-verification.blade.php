@extends('edu_portal.admin.pages.auth.layouts.app')


@section('content')
      <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="{{url('/')}}" class="d-block auth-logo">
                                            <img src="{{asset('edu_portal/assets/images/eduportal-white.png')}}" alt="" height="28"> <span class="logo-txt">Edu Portal</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">

                                            <div class="avatar-lg mx-auto">
                                                <div class="avatar-title rounded-circle bg-light">
                                                    <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="p-2 mt-4">

                                                <h4>Verify your email</h4>
                                                <p class="mb-5">Please enter the 4 digit code sent to <span class="fw-bold">@{{email}}</span></p>

                                                <div class="alert alert-danger alert-dismissible fade show" role="alert" v-show="server_errors_switch">
                                                    <div v-for="error in server_errors">
                                                            @{{ server_errors  }}
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>


                                                <div>
                                                    <div class="row">
                                                        <div class="mb-3">
                                                            <label class="form-label">Enter OTP</label>
                                                            <input type="text" class="form-control" id="OTP" placeholder="Enter OTP" v-model="otp">
                                                        </div>
                                                    </div>

                                                    <div class="mt-4">
                                                        <button class="btn btn-primary w-100 waves-effect waves-light" @click="verify_otp">Confirm OTP</button>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Didn't receive an email ? <a
                                                class="text-primary fw-semibold" @click="resend_otp"> Resend </a> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="auth-bg pt-md-5 p-4 d-flex">
                            <div class="bg-overlay bg-primary"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- end bubble effect -->
                            <div class="row justify-content-center align-items-center">
                                <div class="col-xl-7">
                                    <div class="p-0 p-sm-4 px-xl-0">
                                        <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">

                                            </div>
                                            <!-- end carouselIndicators -->
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="testi-contain text-white">
                                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                        <h4 class="mt-4 fw-medium lh-base text-white">“We have sent your OTP to your Email , Please check and type it in and click on the confirm button .”
                                                        </h4>

                                                    </div>
                                                </div>

                                            </div>
                                            <!-- end carousel-inner -->
                                        </div>
                                        <!-- end review carousel -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>
@endsection
@section('script')
    <script>
        let email = "{{$email}}";
    </script>
    <script src="{{asset('easy_school/admin/plugins/pages/otp-verification.js')}}"></script>
@endsection
