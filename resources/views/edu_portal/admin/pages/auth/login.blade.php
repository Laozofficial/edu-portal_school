@extends('edu_portal.admin.pages.auth.layouts.app')


@section('content')


 <!-- login page with video background start-->
            <div class="auth-bg-video">
                <video id="bgvid" poster="{{asset('edu_portal/assets/images/other-images/coming-soon-bg.jpg')}}" playsinline="" autoplay="" muted="" loop="">
                    <source src="http://admin.pixelstrap.com/xolo/assets/video/auth-bg.mp4" type="video/mp4">
                </video>
                <div class="authentication-box">
                    <div class="mt-4">
                        <div class="card-body">
                            <div class="cont ">
                                <div>
                                    <div class="theme-form">
                                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert" v-show="server_errors_switch">
                                             <div v-for="error in server_errors">
                                                 <strong>Error!</strong> @{{ error  }}
                                            </div>
                                        <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <h4>LOGIN</h4>
                                        <div class="form-group">
                                            <label class="col-form-label pt-0">Email</label>
                                            <input class="form-control" type="text" v-model="email">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Password</label>
                                            <input class="form-control" type="password" v-model="password">
                                        </div>
                                        <div class="checkbox p-0">
                                            <input id="checkbox1" type="checkbox">
                                            <label for="checkbox1">Remember me</label>
                                        </div>
                                        <div class="form-group form-row mt-3 mb-0">
                                            <button class="btn btn-primary btn-block" type="submit" @click="login">LOGIN</button>
                                        </div>
                                        <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary"
                                                href="{{url('dashboard/auth/register')}}">Sign up</a></p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- login page with video background end-->


@endsection
@section('script')
        <script src="{{asset('easy_school/admin/plugins/pages/login.js')}}"></script>
@endsection
