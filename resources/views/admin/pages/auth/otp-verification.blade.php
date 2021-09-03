@extends('admin.pages.auth.layouts.app')


@section('content')


 <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="{{url('/')}}"><img src="{{asset('admin/images/easyschool_logo.png')}}" alt="" style="width: 50%"></a>
                                    </div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" v-model="email" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Enter OTP</strong></label>
                                            <input type="number" class="form-control" v-model="otp">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
                                        </div>
                                    </div>
                                    <div class="new-account mt-3">
                                        <p>Didn't get an OTP? <a class="text-primary" @click="resend_otp">Resend OTP</a></p>
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
    <script>
        let email = "{{$email}}";
    </script>
    <script src="{{asset('admin/plugins/pages/otp-verification.js')}}"></script>
@endsection
