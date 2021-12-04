@extends('easy_school.Student.pages.auth.layouts.app')


@section('content')

<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6 mt-lg-5">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form shadow-lg">
                                <div class="text-center mt-3">
                                    <a href="{{url('/')}}"><img
                                            src="{{asset('easy_school/admin/images/easyschool_logo.png')}}" alt=""
                                            style="width: 50%"></a>
                                </div>
                                <h4 class="text-center mb-4 mt-5">Student Login</h4>

                                <div>
                                    <div class="alert alert-danger alert-dismissible fade show mt-2"
                                        v-show="server_errors_switch">
                                        <div v-for="error in server_errors">
                                            <strong>Error!</strong> @{{ error  }}
                                        </div>
                                        <button type="button" class="close h-100" data-dismiss="alert"
                                            aria-label="Close" @click="server_errors_switch = false"><span><i
                                                    class="mdi mdi-close"></i></span>
                                        </button>
                                    </div>

                                    <div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>School Identification Number</strong></label>
                                            <input type="email" class="form-control" v-model="s_id">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" v-model="password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <a href="#">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block" @click="login">Sign
                                                Me In</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="containe">
                                    <div class="mt-3"></div>
                                    <div class="card shadow-lg">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a class="text-primary" href="{{ url('/dashboard/teacher/auth/login') }}"><i class="fa fa-graduation-cap"></i>
                                                        Teacher Login</a>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <a href="{{ url('/dashboard/auth/login') }}" class="text-primary"><i
                                                            class="fa fa-user"></i>Admin
                                                        Login</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/studentt-login.js')}}"></script>
@endsection
