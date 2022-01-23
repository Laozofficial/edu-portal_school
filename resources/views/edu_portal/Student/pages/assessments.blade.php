@extends('edu_portal.student.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Student Assessment </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                    <li class="breadcrumb-item active">Starter Page</li> -->
                </ol>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    Assessments
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Academic Year</th>
                                <th scope="col">Assessment Type</th>
                                <th scope="col">Class</th>
                                <th scope="col">Score</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Term</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(assessment, index) in assessments.data">
                                <th scope="row">@{{ index + 1 }}</th>
                                <td>@{{ assessment.academic_year.name }}</td>
                                <td>@{{ assessment.assessment_type.name }}</td>
                                <td>@{{ assessment.level.name }}</td>
                                <td>@{{ assessment.score }} marks</td>
                                <td>@{{ assessment.subject.name }}</td>
                                <td>@{{ assessment.term.name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <vue-pagination :total-items="assessments.total" :page="page" :loading="loading_assessments"
                        :items-per-page="assessments.per_page" v-on:page-change="pageChange">
                    </vue-pagination>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/student-assessments.js')}}"></script>
@endsection
