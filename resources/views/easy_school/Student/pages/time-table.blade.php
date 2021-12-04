@extends('easy_school.student.layouts.app')



@section('content')

<div class="text-center" v-show="loading" id="page_loader">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content" id="show_content">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">School Time Table</h2>
            <p class="mb-0">Check Time Table</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header">

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/student_time_table.js')}}"></script>
@endsection
