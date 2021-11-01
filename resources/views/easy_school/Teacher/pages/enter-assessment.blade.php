@extends('easy_school.teacher.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Academics</h2>
            <p class="mb-0">Enter Student Assessments</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            Enter Student Assessments
                        </div>
                        <div class="col-md-8 text">
                             <label class="d-block fs-16">Select Institution</label>
                             <v-select :options="classes" label="name" v-model="selected_class"
                                 :reduce="classes => classes.id" @input="fetch_students" id="class">
                             </v-select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Admission Number</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Date of Birth</th>
                                        <th scope="col">Religion</th>
                                        <th scope="col">Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(student, index) in students.data">
                                        <td>@{{ index + 1 }}</td>
                                        <td>@{{ student.full_name_text }}</td>
                                        <td>@{{ student.admission_number }}</td>
                                        <td>@{{ student.gender }}</td>
                                        <td>@{{ student.date_of_birth }}</td>
                                        <td>@{{ student.religion }}</td>
                                        <td>@{{ student.present_address }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-xs" @click="add_assessment(student.id)">
                                                <i class="fa fa-plus"></i> Add Assessment
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="card-footer">
                      <vue-pagination :total-items="students.total" :page="page" :loading="loading_students"
                          :items-per-page="students.per_page" v-on:page-change="pageChange">
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
                         <v-select :options="sessions" label="name" v-model="selected_session"
                             :reduce="sessions => sessions.id" id="sessions" @input="get_terms"></v-select>
                         <br>
                         <span class=" mt-3">Select Term <span class="text-danger">*</span></span>
                         <v-select :options="terms" label="name" v-model="selected_term" :reduce="terms => terms.id"
                             id="terms"></v-select>
                         <br>
                         <span class=" mt-3">Select Class <span class="text-danger">*</span></span>
                         <v-select :options="levels" label="name" v-model="selected_level" :reduce="levels => levels.id"
                             id="levels" @input="get_subjects_in_a_class"></v-select>
                         <br>
                         <span class=" mt-3">Select Subject <span class="text-danger">*</span></span>
                         <v-select :options="subjects" label="name" v-model="selected_subject"
                             :reduce="subjects => subjects.id" id="subjects"></v-select>
                         <br>
                         <span class=" mt-3">Select Assessment Type <span class="text-danger">*</span></span>
                         <v-select :options="assessment_types" label="name" v-model="selected_assessment_type"
                             :reduce="assessments => assessments.id" id="assessments"></v-select>
                         <br>
                         <label for="" class="mt-3">Enter Exam Score</label>
                         <input class="form-control form-control-sm" type="number" v-model="score"
                             placeholder="Enter Score" />

                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                         <button type="button" class="btn btn-primary" @click="save_assessment">Record Assessment for
                             @{{ student.full_name_text }}</button>
                     </div>
                 </div>
             </div>
         </div>

</div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/teacher-enter-assessment.js')}}"></script>
@endsection
