@extends('edu_portal.admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Welcome Back</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                    <li class="breadcrumb-item active">Getting Started</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100 shadow-lg">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Schools Registered</span>
                        <h4 class="mb-3">
                            <span class="counter-value" style="font-size: 5rem !important" data-target="1">0</span>
                        </h4>
                    </div>
                    <div class="col-6">
                       <!-- <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>-->
                    </div>
                </div>
                <div class="text-nowrap">
                    <!----><span class="badge bg-soft-success text-success">Last Registered on</span>
                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->


    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Number of Students</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="6258">0</span>
                        </h4>
                    </div>
                    <div class="col-6">
                        <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-soft-danger text-danger">-29 Trades</span>
                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col-->
















</div>




@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/index.js')}}"></script>
@endsection
