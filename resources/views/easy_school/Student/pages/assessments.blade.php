@extends('easy_school.student.layouts.app')



@section('content')

<div class="text-center" v-show="loading" id="page_loader">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content" id="show_content">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Student Assessment</h2>
            <p class="mb-0">Your Aessessments</p>
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
</div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/student-assessments.js')}}"></script>
@endsection
