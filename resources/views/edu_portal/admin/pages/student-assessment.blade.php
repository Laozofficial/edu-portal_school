@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add Student Assessment</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Academics</a></li>
                        <li class="breadcrumb-item active">Student Assessment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
          <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Students
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="d-block fs-16">Select Institution</span>
                            <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_students" id="institution"></v-select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="cad">
                            <div class="card-ody">
                                <div class="row">
                                    <div class="col-md-4 pr-0">
                                        <input class="form-control form-control-sm pr-0" placeholder="search student by first or last name " type="text" style="height: 30px" v-model="q"/>
                                    </div>
                                    <div class="col-md-4 pl-1">
                                        <button class="btn btn-sm btn-info pl-1" style="height: 28px; border-radius: 0 !important" @click="search_student"><i class="fa fa-search" style="height: 28px; "></i> search</button>
                                    </div>
                                </div>
                               <div class="table table-sm mt-3">
                                    <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th><strong>S/N</strong></th>
                                                <th><strong>Student Name</strong></th>
                                                <th><strong>Email</strong></th>
                                                <th><strong>Gender</strong></th>
                                                <th><strong>State</strong></th>
                                                <th><strong>Current Class</strong></th>
                                                <th><strong>Joined</strong></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(student, index) in students.data">
                                                <td><strong>@{{index + 1}}</strong></td>
                                                <td>@{{student.full_name_text}}</td>
                                                <td><div class="d-flex align-items-center">
                                                    <span class="w-space-no">@{{student.user.email}}</span></div>
                                                </td>
                                                <td>@{{ student.gender }}	</td>
                                                <td><div class="d-flex align-items-center"> @{{student.state.name}} state</div> </td>
                                                <td v-if="student.level !== null"> <i class="fa fa-circle text-success mr-1"></i> @{{  student.level.name }}</td>
                                                <td v-else><i class="fa fa-circle text-danger mr-1"></i> Not Assigned to class , cannot record assessment</td>
                                                <td>@{{ student.created_at_text }}</td>
                                                <td v-if="student.level !== null">
                                                    <button class="btn btn-info btn-sm shadow" @click="record_assessment(student.id)">
                                                        <i class="fa fa-tasks"></i>  Record Assessment
                                                    </button>
                                                </td>
                                                <td v-else>
                                                    <button class="btn btn-danger btn-sm" @click="go_to_student">
                                                        <i class="fa fa-link"></i>Assign to a Class
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" @click="get_student_assessments(student.id)">
                                                        <i class="fa fa-eye"></i> All Assessments
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                     <vue-pagination
                        :total-items="students.total"
                        :page="page"
                        :loading="loading_students"
                        :items-per-page="students.per_page"
                        v-on:page-change="pageChange"
                    >
                    </vue-pagination>
                </div>
            </div>
        </div>
     </div>


     <div class="modal fade" id="record_assessment">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Record Assessment</h5>
                </div>
                <div class="modal-body">
                     <span class="">Select Academic Session <span class="text-danger">*</span> </span>
                    <v-select :options="sessions" label="name" v-model="selected_session" :reduce="sessions => sessions.id" id="sessions" @input="get_terms"></v-select>
                    <br>
                    <span class=" mt-3">Select Term <span class="text-danger">*</span></span>
                    <v-select :options="terms" label="name" v-model="selected_term" :reduce="terms => terms.id" id="terms" ></v-select>
                    <br>
                    <span class=" mt-3">Select Class <span class="text-danger">*</span></span>
                    <v-select :options="levels" label="name" v-model="selected_level" :reduce="levels => levels.id" id="levels" @input="get_subjects_in_a_class"></v-select>
                    <br>
                    <span class=" mt-3">Select Subject <span class="text-danger">*</span></span>
                    <v-select :options="subjects" label="name" v-model="selected_subject" :reduce="subjects => subjects.id" id="subjects"></v-select>
                    <br>
                    <span class=" mt-3">Select Assessment Type <span class="text-danger">*</span></span>
                    <v-select :options="assessment_types" label="name" v-model="selected_assessment_type" :reduce="assessments => assessments.id" id="assessments"></v-select>
                    <br>
                    <label for="" class="mt-3">Enter Exam Score</label>
                    <input class="form-control form-control-sm" type="number" v-model="score" placeholder="Enter Score"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="save_assessment">Record Assessment for @{{ student.full_name_text }}</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/student-assessment.js')}}"></script>
@endsection
