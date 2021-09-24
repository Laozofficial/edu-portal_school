@extends('edu_portal.admin.pages.auth.layouts.app')


@section('content')
      <div class="page-wrapper">
      <div class="container-fluid p-0">
        <!-- login page with video background start-->
        <div class="auth-bg-video">
          <video id="bgvid" poster="{{asset('edu_portal/assets/images/other-images/coming-soon-bg.jpg')}}" playsinline="" autoplay="" muted="" loop="">
            <source src="http://admin.pixelstrap.com/xolo/assets/video/auth-bg.mp4" type="video/mp4">
          </video>
          <div class="authentication-box">
            <div class="mt-4">
              <div class="card-body">
                <div class="cont text-center s--signup">
                  <div>
                     <div class="theme-form">
                              <h4 class="text-center">NEW USER</h4>
                              <h6 class="text-center">Enter your Username and Password For Signup</h6>
                              <div class="alert alert-danger dark alert-dismissible fade show" role="alert" v-show="server_errors_switch">
                                     <strong>Error!</strong> @{{ server_errors  }}
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                              <div class="form-row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Email" v-model="email" disabled>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <input class="form-control" type="number" placeholder="OTP" v-model="otp">
                                  </div>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="col-sm-4">
                                  <button class="btn btn-primary" type="submit" @click="verify_otp">Verify OTP</button>
                                </div>
                                <div class="col-sm-4">
                                  <button class="btn btn-success" type="submit" @click="resend_otp">Resend OTP</button>
                                </div>
                              </div>
                            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- login page with video background end-->
      </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/register.js')}}"></script>
@endsection
