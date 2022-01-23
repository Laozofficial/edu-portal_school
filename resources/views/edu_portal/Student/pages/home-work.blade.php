@extends('edu_portal.student.layouts.app')
@section('style')
<link href="{{ asset('easy_school/admin/vendor/summernote/summernote.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Assignments</h4>
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
                                    <a :href=`/dashboard/student/submit-answers/${home_work.id}`
                                        class="btn btn-primary btn-xs text-white">
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

    <!-- <div class="mt-5 card shadow-lg">
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
                    <input class="form-control form-control-sm form-control-file" type="file" />
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div> -->

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
    integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
</script>
<script src="{{ asset('easy_school/admin/vendor/summernote/js/summernote.min.js') }}"></script>
<script src="{{asset('easy_school/admin/plugins/pages/student-home-work.js')}}"></script>
@endsection
