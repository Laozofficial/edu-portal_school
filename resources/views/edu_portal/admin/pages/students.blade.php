@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Students</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Students</a></li>
                        <!-- <li class="breadcrumb-item active">Starter Page</li> -->
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
                            <h4>Students</h4>
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
                                                <th><strong>Admission Number</strong></th>
                                                <th><strong>Gender</strong></th>
                                                <th><strong>State</strong></th>
                                                <th><strong>Current Class</strong></th>
                                                <th><strong>Joined</strong></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(student, index) in students.data">
                                                <td><strong>@{{index + 1}}</strong></td>
                                                <td>@{{student.full_name_text}}</td>
                                                <td><div class="d-flex align-items-center">
                                                    <span class="w-space-no">@{{student.admission_number}}</span></div>
                                                </td>
                                                <td>@{{ student.gender }}	</td>
                                                <td><div class="d-flex align-items-center"> @{{student.state.name}} state</div> </td>
                                                <td v-if="student.level !== null"> <i class="fa fa-circle text-success mr-1"></i> @{{  student.level.name }}</td>
                                                <td v-else><i class="fa fa-circle text-danger mr-1"></i> Not Assigned</td>
                                                <td>@{{ student.created_at_text }}</td>
                                                 <td>
													<div class="d-flex">
														<a @click="view_student(student.id)" class="btn btn-primary shadow btn-sm sharp mr-1"><i class="fa fa-eye text-white"></i></a>
													</div>
												</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a @click="update_student(student.id)"
                                                            class="btn btn-success shadow btn-sm sharp mr-1"><i
                                                                class="fa fa-pen text-white"></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-sm shadow" @click="assign_to_class(student.id)">
                                                        <i class="fa fa-tasks"></i>  assign to class
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm shadow"
                                                        @click="make_alumni(student.id)">
                                                        <i class="fa fa-graduation-cap"></i> Make Alumni
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


    <div class="modal fade" id="assign-class">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Student To class</h5>n>&times;</span>
                </div>
                <div class="modal-body p-lg-5">
                    <label>Select Class</label>
                    <v-select :options="classes" label="name" v-model="selected_class" :reduce="levels => levels.id"  id="levels"></v-select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="assign_class" :disabled="isNaN(selected_class)">Assign Class to @{{ student.first_name }}</button>
                </div>
            </div>
        </div>
    </div>

      <div class="modal fade" id="update_school" data-backdrop="static">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Update Student Details</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                      </button>
                  </div>
                  <div class="modal-body p-lg-5">
                      <div v-for="error in errors" class="mb-4 col-md-12 container">
                          <div class="alert alert-danger alert-dismissible fade show" v-show="alert">
                              <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                  fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                  <polygon
                                      points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                  </polygon>
                                  <line x1="15" y1="9" x2="9" y2="15"></line>
                                  <line x1="9" y1="9" x2="15" y2="15"></line>
                              </svg>
                              <strong>Error!</strong> @{{error}}
                              <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                          class="mdi mdi-close"></i></span>
                              </button>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">
                              <label>Student First Name</label>
                              <input class="form-control form-control-sm mb-3" type="text"
                                  v-model="student.first_name" />

                              <label>Student last Name</label>
                              <input class="form-control form-control-sm mb-3" type="text"
                                  v-model="student.last_name" />


                              <label for="passport_image">Update Passport Image</label>
                              <div class="input-group">
                                  <div class="custom-file">
                                      <input type="file" class="custom-file-input" @change="onPassportChange">
                                      <label class="custom-file-label">Choose file</label>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <label>Student Middle Name</label>
                              <input class="form-control form-control-sm mb-3" type="text"
                                  v-model="student.middle_name" />

                              <label>Student Present Address</label>
                              <input class="form-control form-control-sm mb-3" type="text"
                                  v-model="student.present_address" />

                              <label>Student Date of Birth</label>
                              <input class="form-control form-control-sm mb-3" type="date"
                                  v-model="student.date_of_birth" />
                          </div>
                      </div>
                      <div class="mt-5"></div>
                      <hr>
                      <div class="mt-5"></div>
                      <h5 class="text-center mb-4">Change @{{ student.first_name }}'s Password</h5>
                      <div class="row">
                          <div class="col-md-6">
                              <label>Enter New Password</label>
                              <input class="form-control form-control-sm" type="password" v-model="password" />
                          </div>
                          <div class="col-md-6">
                              <label>Confirm New Password</label>
                              <input class="form-control form-control-sm" type="password"
                                  v-model="password_confirmation" />
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                       <button type="button" class="btn btn-sm btn-danger waves-effect"
                           data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary btn-sm" @click="update_profile">Update
                          @{{ student.first_name }} Profile</button>
                  </div>
              </div>
          </div>
      </div>


@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/students.js')}}"></script>
@endsection
