@extends('admin.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>All Entered Schools!</h4>
                <!-- <p class="mb-0">Your business dashboard template</p> -->
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">School</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">All Schools</a></li>
            </ol>
        </div>
    </div>

     <div class="row">

     </div>

</div>

@endsection
@section('script')
    <script src="{{asset('admin/plugins/pages/update-school.js')}}"></script>
@endsection
