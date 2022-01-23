@extends('edu_portal.teacher.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Students</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Students</a></li>
                    <li class="breadcrumb-item active">Student</li>
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
                      <div class="col-md-4">
                          Students
                      </div>
                      <div class="col-md-8 text">
                          <label class="d-block fs-16">Select Class</label>
                         <v-select :options="classes" label="name" v-model="selected_class"
                             :reduce="classes => classes.id" @input="get_students" id="institution"></v-select>
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
                                      <button class="btn btn-primary btn-xs" @click="view_records(student.id)">
                                          <i class="fa fa-eye"></i> View Records
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
@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/teacher-students.js')}}"></script>
@endsection
