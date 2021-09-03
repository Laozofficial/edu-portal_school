@extends('admin.pages.auth.layouts.app')


@section('content')
<style>
    .resend_otp{ 
        cursor:  !important;
    }
</style>

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
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" v-show="server_errors_switch">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                             <strong>Error!</strong> @{{ server_errors  }}
                                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                        </button>
                                    </div>


                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" v-model="email" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Enter OTP</strong></label>
                                            <input type="number" class="form-control" v-model="otp">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block" @click="verify_otp">Verify OTP</button>
                                        </div>
                                    </div>
                                    <div class="new-account mt-3">
                                        <p>Didn't get an OTP? <a class="text-primary"id="resend_otp" @click="resend_otp">Resend OTP</a></p>
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
