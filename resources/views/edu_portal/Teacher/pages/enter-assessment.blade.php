@extends('edu_portal.teacher.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Assessments</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Enter Assessments</a></li>
                    <!-- <li class="breadcrumb-item active">Starter Page</li> -->
                </ol>
            </div>
        </div>
    </div>
</div>

 <!-- <div class="row">
      <div class="col-md-12">
          <div class="card shadow-lg">
              <div class="card-header">
                  <div class="row">
                      <div class="col-md-8">
                          Enter Student Assessments
                      </div>
                      <div class="col-md-4 text">
                          <label class="d-block fs-16">Select Class</label>
                          <v-select :options="classes" label="name" v-model="selected_class"
                              :reduce="classes => classes.id" @input="fetch_students" id="class">
                          </v-select>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Student Name</th>
                                  <th scope="col">Admission Number</th>
                                  <th scope="col">Gender</th>
                                  <th scope="col">Date of Birth</th>

                                  <th scope="col">Academic Session</th>
                                  <th scope="col">Academic Term</th>
                                  <th scope="col">Subject</th>
                                  <th scope="col">Assessment Type</th>
                                  <th scope="col">Enter Score</th>
                                  <th></th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(student, index) in students.data" class="mb-3">
                                  <td>@{{ index + 1 }}</td>
                                  <td>@{{ student.full_name_text }}</td>
                                  <td>@{{ student.admission_number }}</td>
                                  <td>@{{ student.gender }}</td>
                                  <td>@{{ student.date_of_birth }}</td>
                                  <td>
                                       <v-select :options="sessions" label="name" v-model="selected_session"
                                           :reduce="sessions => sessions.id" id="sessions" @input="get_terms"
                                           v-show="student_id == student.id">
                                       </v-select>
                                  </td>
                                  <td>
                                        <v-select :options="terms" label="name" v-model="selected_term"
                                            :reduce="terms => terms.id" id="terms" v-show="student_id == student.id">
                                            </v-select>
                                  </td>
                                  <td>
                                       <v-select :options="subjects" label="name" v-model="selected_subject"
                                           :reduce="subjects => subjects.id" id="subjects" v-show="student_id == student.id"></v-select>
                                  </td>
                                  <td>
                                       <v-select :options="assessment_types" label="name"
                                           v-model="selected_assessment_type" :reduce="assessments => assessments.id"
                                           id="assessments" v-show="student_id == student.id"></v-select>
                                  </td>
                                  <td>
                                      <input class="form-control form-control-sm" type="number" v-model="score"
                                          placeholder="Enter Score" v-show="student_id == student.id"/>
                                  </td>
                                  <td>
                                      <button class="btn btn-primary btn-sm" @click="add_assessment(student.id)">
                                          <i class="fa fa-sync"></i>
                                      </button>
                                  </td>
                                  <td>
                                      <button class="btn btn-success btn-sm" @click="save_assessment">
                                          <i class="fa fa-paper-plane"></i>
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
  </div>-->

  <div class="row">
      <div class="col-md-3">
        <div class="card shadow-lg">
            <div class="card-header">
                Select Details
            </div>
            <div class="card-body">
                <label for="">Select Class</label>
                <v-select :options="classes" label="name" v-model="selected_class" :reduce="classes => classes.id"
                    @input="get_class_from_subject" id="class">
                </v-select>
                    <br>
                  <span class=" mt-3">Select Term <span class="text-danger">*</span></span>
                  <v-select :options="terms" label="name" v-model="selected_term" :reduce="terms => terms.id"
                      id="terms"></v-select>
                  <br>

                  <span class=" mt-3">Select Subject <span class="text-danger">*</span></span>
                  <v-select :options="subjects" label="name" v-model="selected_subject"
                      :reduce="subjects => subjects.id" id="subjects"></v-select>
                  <br>
                  <span class=" mt-3">Select Assessment Type <span class="text-danger">*</span></span>
                  <v-select :options="assessment_types" label="name" v-model="selected_assessment_type"
                      :reduce="assessments => assessments.id" id="assessments"></v-select>
                  <br>

            </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card shadow-lg">
            <div class="card-header">
                Students
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                       <thead>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Admission Number</th>
                            <th scope="col">Academic session</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Score</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                       </thead>
                       <tbody>
                           <tr v-for="(student, index) in students.data" :key="index">
                            <td>@{{ index + 1 }}</td>
                            <td>@{{ student.full_name_text }}</td>
                            <td>@{{ student.admission_number }}</td>
                            <td>@{{ active_session.name }}</td>
                            <td>@{{ student.gender }}</td>
                            <td>@{{ student.date_of_birth }}</td>
                            <td>
                               <input class="form-control form-control-sm" type="number"
                                   placeholder="Enter Score" v-model="score" v-if="student_id == student.id"/>
                            </td>
                              <td>
                                <button class="btn btn-sm btn-primary" @click="student_id = student.id">
                                    <i class="fa fa-plus"></i>
                                </button>
                              </td>
                            <td>
                                <button class="btn btn-sm btn-success" @click="save_assessment(student.id)">
                                    <i class="fa fa-paper-plane"></i>
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
                  <input class="form-control form-control-sm" type="number" v-model="score" placeholder="Enter Score" />

              </div>
              <div class="modal-footer">
                  <div id="modal-close-library"></div>
                  <button type="button" class="btn btn-primary" @click="save_assessment">Record Assessment for
                      @{{ student.full_name_text }}</button>
              </div>
          </div>
      </div>
  </div>


@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/teacher-enter-assessment.js')}}"></script>
@endsection
