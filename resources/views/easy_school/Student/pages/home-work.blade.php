@extends('easy_school.student.layouts.app')

@section('style')
    <link href="{{ asset('easy_school/admin/vendor/summernote/summernote.css') }}" rel="stylesheet">
@endsection


@section('content')

<div class="text-center" v-show="loading" id="page_loader">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content" id="show_content">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">School Assignments</h2>
            <p class="mb-0">Check all Assignments</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    Assignments
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Academic Year</th>
                                <th scope="col">Term</th>
                                <th scope="col">Class</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Score</th>
                                <th scope="col">Download Assignment</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(home_work, index) in assignments.data">
                                <th scope="row">@{{ index + 1 }}</th>
                                <td>@{{ home_work.academic_year.name }}</td>
                                <td>@{{ home_work.term.name }}</td>
                                <td>@{{ home_work.level.name }}</td>
                                <td>@{{ home_work.subject.name }}</td>
                                <td>@{{ home_work.teacher.full_name_text }}</td>
                                <td>@{{ home_work.submission_date_text }}</td>
                                <td>@{{ home_work.score }} marks</td>
                                <td>
                                    <a :href="home_work.full_path_link" class="text-primary">
                                        Download Assignment
                                    </a>
                                </td>
                                <td>
                                    <a :href=`/dashboard/student/submit-answers/${home_work.id}` class="btn btn-primary btn-xs text-white">
                                        <i class="fa fa-paper-plane"></i> Submit Answer
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 card shadow-lg">
        <div class="card-header">
            Submit Answer
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Type Out Your Answer</label>
                    <textarea class="summernote" id="summernote"></textarea>
                    <legend class="text-center mt-5"><mark>OR</mark></legend>

                    <label class="mt-5">Upload a document containing the answer to the assignment</label>
                    <input class="form-control form-control-sm form-control-file" type="file"/>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<script src="{{ asset('easy_school/admin/vendor/summernote/js/summernote.min.js') }}"></script>
<script src="{{asset('easy_school/admin/plugins/pages/student-home-work.js')}}"></script>
@endsection
