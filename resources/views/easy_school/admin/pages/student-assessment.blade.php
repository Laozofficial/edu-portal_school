@extends('easy_school.admin.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
     <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Add Assessment</h2>
            <p class="mb-0">Add Student Assessment</p>
        </div>
        <div class="dropdown custom-dropdown">
            <div class="btn btn-sm btn-primary light d-flex align-items-center svg-btn" data-toggle="dropdown">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path d="M22.4281 2.856H21.8681V1.428C21.8681 0.56 21.2801 0 20.4401 0C19.6001 0 19.0121 0.56 19.0121 1.428V2.856H9.71606V1.428C9.71606 0.56 9.15606 0 8.28806 0C7.42006 0 6.86006 0.56 6.86006 1.428V2.856H5.57206C2.85606 2.856 0.560059 5.152 0.560059 7.868V23.016C0.560059 25.732 2.85606 28.028 5.57206 28.028H22.4281C25.1441 28.028 27.4401 25.732 27.4401 23.016V7.868C27.4401 5.152 25.1441 2.856 22.4281 2.856ZM5.57206 5.712H22.4281C23.5761 5.712 24.5841 6.72 24.5841 7.868V9.856H3.41606V7.868C3.41606 6.72 4.42406 5.712 5.57206 5.712ZM22.4281 25.144H5.57206C4.42406 25.144 3.41606 24.136 3.41606 22.988V12.712H24.5561V22.988C24.5841 24.136 23.5761 25.144 22.4281 25.144Z" fill="#2F4CDD"></path>
                    </g>
                </svg>
                <div class="text-left ml-3">
                    <span class="d-block fs-16">Select Institution</span>
                    <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_students" id="institution"></v-select>
                </div>
                <i class="fa fa-angle-down scale5 ml-3"></i>
            </div>
            <!-- <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">4 June 2020 - 4 July 2020</a>
                <a class="dropdown-item" href="#">5 july 2020 - 4 Aug 2020</a>
            </div> -->
        </div>
    </div>

     <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Students</h4>
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
                                                    <button class="btn btn-info btn-xs shadow" @click="record_assessment(student.id)">
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
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="save_assessment">Record Assessment for @{{ student.full_name_text }}</button>
                </div>
            </div>
        </div>
    </div>




</div>

@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/student-assessment.js')}}"></script>
@endsection
