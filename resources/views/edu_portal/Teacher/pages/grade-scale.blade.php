@extends('edu_portal.teacher.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Grade Scale</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Grade Scale list</a></li>
                    <!-- <li class="breadcrumb-item active">Starter Page</li> -->
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg">
            <div class="card-header">
                Grades
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md table-bordered">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#</strong></th>
                                <th><strong>Grade</strong></th>
                                <th><strong>From</strong></th>
                                <th><strong>To</strong></th>
                                <th><strong>Created at</strong></th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(grade, index) in grade_scale">
                                <td><strong>@{{index + 1}}</strong></td>
                                <td>@{{grade.grade}}</td>
                                <td>@{{grade.lower_value}}</td>
                                <td>@{{grade.upper_value}}</td>
                                <td>@{{grade.created_at_text}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/teacher-grade-scale.js')}}"></script>
@endsection
