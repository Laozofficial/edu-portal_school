@extends('admin.layouts.app')



@section('content')

    <div class="container fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Add Institution</h4>
                    <span>create an institution</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard/admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Institution</a></li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Add Institution
            </div>
            <div class="card-body">

            </div>
        </div>


    </div>





@endsection
@section('script')
    <script src="{{asset('admin/plugins/pages/add-school.js')}}"></script>
@endsection

