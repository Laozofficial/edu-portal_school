@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add Assessment</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Assessment</a></li>
                        <li class="breadcrumb-item active">Add Assessment </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
     <script src="{{asset('easy_school/admin/plugins/pages/enter-assessment-types.js')}}"></script>
@endsection
