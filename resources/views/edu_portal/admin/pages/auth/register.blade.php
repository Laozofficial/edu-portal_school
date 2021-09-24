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
                              <div class="alert alert-danger dark alert-dismissible fade show" role="alert" v-show="server_error_switch">
                                    <div v-for="error in server_errors">
                                        <strong>Error!</strong> @{{ error  }}
                                </div>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                              <div class="form-row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Full Name" v-model="name">
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Email" v-model="email">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <input class="form-control" type="text" placeholder="Phone Number" v-model="phone">
                              </div>
                              <div class="form-group">
                                <input class="form-control" type="password" placeholder="Password" v-model="password">
                              </div>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Password" v-model="password_confirmation">
                              </div>
                              <div class="form-row">
                                <div class="col-sm-4">
                                  <button class="btn btn-primary" type="submit" @click="validate">Sign Up</button>
                                </div>
                                <div class="col-sm-8">
                                  <div class="text-left mt-2 m-l-20">Are you already user?  <a class="btn-link text-capitalize" href="{{url('dashboard/auth/login')}}">Login</a></div>
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
