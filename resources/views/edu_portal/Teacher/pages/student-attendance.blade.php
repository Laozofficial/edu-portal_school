@extends('edu_portal.teacher.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Student Attendance</h4>
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
                <div class="row">
                    <div class="col-md-6">
                        Students
                    </div>
                    <div class="col-md-6 ">
                        <label class="d-block fs-16">Select Class</label>
                        <v-select :options="classes" label="name" v-model="selected_class"
                            :reduce="classes => classes.id" @input="get_students" id="institution" class="w-50"></v-select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
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
                                    <button class="btn btn-primary btn-sm" @click="add_attendance(student.id)">
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
            </div>
            <div class="modal-body">
                <span class="">Select Academic Session <span class="text-danger">*</span> </span>
                <v-select :options="sessions" label="name" v-model="selected_session" :reduce="sessions => sessions.id"
                    id="sessions" @input="get_terms"></v-select>
                <br>
                <span class=" mt-3">Select Term <span class="text-danger">*</span></span>
                <v-select :options="terms" label="name" v-model="selected_term" :reduce="terms => terms.id" id="terms">
                </v-select>
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
                <input class="form-control form-conrtol-sm" type="date" v-model="date_recorded" />

            </div>
            <div class="modal-footer">
                <div id="modal-close-library"></div>
                <button type="button" class="btn btn-primary btn-sm" @click="record_attendance">Record Attendance
                    @{{ student.full_name_text }} </button>
            </div>
        </div>
    </div>
</div>



@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/teacher-student-attendance.js')}}"></script>
@endsection
