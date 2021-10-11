@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add School</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

      <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Student Assessments
                        </div>
                        <div class="col-md-6 text-right">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Student Name</strong></th>
                                    <th><strong>Academic Year</strong></th>
                                    <th><strong>Assessment Type</strong></th>
                                    <th><strong>Class</strong></th>
                                    <th><strong>Subject</strong></th>
                                    <th><strong>Term</strong></th>
                                    <th><strong>Score</strong></th>
                                    <th><strong>Created at</strong></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(assessment, index) in assessments.data">
                                    <td><strong>@{{index + 1}}</strong></td>
                                    <td>@{{ assessment.student.full_name_text }}</td>
                                    <td>@{{ assessment.academic_year.name }}</td>
                                    <td>@{{ assessment.assessment_type.name }}</td>
                                    <td>@{{ assessment.level.name }}</td>
                                    <td>@{{ assessment.subject.name }}</td>
                                    <td>@{{ assessment.term.name }}</td>
                                    <td>@{{ assessment.score }} mark(s)</td>
                                    <td>@{{ assessment.created_at_text }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" @click="update_score(assessment.id)">
                                            <i class="fa fa-pen"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <vue-pagination
                        :total-items="assessments.total"
                        :page="page"
                        :loading="loading_assessments"
                        :items-per-page="assessments.per_page"
                        v-on:page-change="pageChange"
                    >
                    </vue-pagination>
                </div>
            </div>
        </div>
     </div>

     <div class="modal fade" id="update_score">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Assessment Score</h5>
                </div>
                <div class="modal-body p-lg-5">
                    <label>Enter New Score</label>
                    <input class="form-control form-controm-sm" type="text" v-model="assessment.score"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="update_assessment_score" :disabled="assessment.score == ''">Update Score</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        let id = "{{ $id }}";
    </script>
    <script src="{{asset('easy_school/admin/plugins/pages/single_student_assessment.js')}}"></script>
@endsection
