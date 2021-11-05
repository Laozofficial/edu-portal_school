@extends('easy_school.teacher.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Attendance</h2>
            <p class="mb-0">Add Attendance</p>
        </div>
        <div class="dropdown custom-dropdown">
            <div class="btn btn-sm btn-primary light d-flex align-items-center svg-btn" data-toggle="dropdown">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path
                            d="M22.4281 2.856H21.8681V1.428C21.8681 0.56 21.2801 0 20.4401 0C19.6001 0 19.0121 0.56 19.0121 1.428V2.856H9.71606V1.428C9.71606 0.56 9.15606 0 8.28806 0C7.42006 0 6.86006 0.56 6.86006 1.428V2.856H5.57206C2.85606 2.856 0.560059 5.152 0.560059 7.868V23.016C0.560059 25.732 2.85606 28.028 5.57206 28.028H22.4281C25.1441 28.028 27.4401 25.732 27.4401 23.016V7.868C27.4401 5.152 25.1441 2.856 22.4281 2.856ZM5.57206 5.712H22.4281C23.5761 5.712 24.5841 6.72 24.5841 7.868V9.856H3.41606V7.868C3.41606 6.72 4.42406 5.712 5.57206 5.712ZM22.4281 25.144H5.57206C4.42406 25.144 3.41606 24.136 3.41606 22.988V12.712H24.5561V22.988C24.5841 24.136 23.5761 25.144 22.4281 25.144Z"
                            fill="#2F4CDD"></path>
                    </g>
                </svg>
                <div class="text-left ml-3">
                     <span class="d-block fs-16">Select Class</span>
                     <v-select :options="classes" label="name" v-model="selected_class" :reduce="classes => classes.id"
                         @input="get_students" id="institution"></v-select>
                </div>
                <i class="fa fa-angle-down scale5 ml-3"></i>
            </div>
        </div>
    </div>

    <div class="row">
          <div class="col-md-12">
              <div class="card shadow-lg">
                  <div class="card-header">
                      Students
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
                                          <button class="btn btn-primary btn-xs" @click="add_attendance(student.id)">
                                              <i class="fa fa-plus"></i> Add Attendance
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


    <div class="modal fade" id="attendance" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Attendance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                          id="levels"></v-select>
                      <br>
                      <label for="" class="mt-3">Attendance Status</label>
                      <div class="form-group">
                          <select class="form-control default-select form-control-lg" v-model="status">
                              <option value="0">Present</option>
                              <option value="1">Absent</option>
                          </select>
                      </div>
                      <label class="mt-3">Date</label>
                      <input class="form-control form-conrtol-sm" type="date" v-model="date_recorded"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="record_attendance">Record Attendance @{{ student.full_name_text }} </button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/teacher-student-attendance.js')}}"></script>
@endsection
