@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">All Teachers</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Teachers</a></li>
                        <li class="breadcrumb-item active">All Teachers</li>
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
                          <div class="col-md-8">
                              All Teachers
                          </div>
                          <div class="col-md-4 text-right">
                            <span class="d-block fs-16">Select Institution</span>
                            <v-select :options="institutions" label="name" v-model="selected_institution"
                                :reduce="institutions => institutions.id" @input="get_teachers" id="institution">
                            </v-select>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-responsive-md">
                              <thead>
                                  <tr>
                                      <th><strong>S/N</strong></th>
                                      <th><strong>Name</strong></th>
                                      <th><strong>Email</strong></th>
                                      <th><strong>Gender</strong></th>
                                      <th><strong>Identification Number</strong></th>
                                      <th><strong>Status</strong></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr v-for="(teacher, index) in teachers.data">
                                      <td><strong>@{{index + 1}}</strong></td>
                                      <td>
                                          <div class="d-flex align-items-center"><img :src="teacher.full_image_path"
                                                  class="rounded-lg mr-2" width="24" alt="" /> <span
                                                  class="w-space-no">@{{teacher.full_name_text}}</span></div>
                                      </td>
                                      <td>@{{teacher.user.email}}</td>
                                      <td>@{{teacher.gender}}</td>
                                      <td>@{{ teacher.user.school_identification_number }}</td>
                                      <td v-if="teacher.user.status == 0">
                                          <div class="d-flex align-items-center"><i
                                                  class="fa fa-circle text-success mr-1"></i>
                                              @{{teacher.user.status_text}}</div>
                                      </td>
                                      <td v-else>
                                          <div class="d-flex align-items-center"><i
                                                  class="fa fa-circle text-danger mr-1"></i>
                                              @{{teacher.user.status_text}}</div>
                                      </td>
                                      <td>
                                          <div class="d-flex">
                                              <a @click="view(teacher.slug)"
                                                  class="btn btn-info shadow btn-sm sharp mr-1"><i
                                                      class="fa fa-eye text-white"></i></a>
                                          </div>
                                      </td>
                                      <td>
                                          <div class="d-flex">
                                              <a @click="update(teacher.slug)"
                                                  class="btn btn-primary shadow btn-sm sharp mr-1"><i
                                                      class="fa fa-pen text-white"></i></a>
                                          </div>
                                      </td>
                                      <td v-if="teacher.user.status == 0">
                                          <div class="d-flex">
                                              <a @click="ban_teacher(teacher.user.id)"
                                                  class="btn btn-danger shadow btn-sm sharp mr-1"><i
                                                      class="fa fa-ban text-white"></i></a>
                                          </div>
                                      </td>
                                      <td v-else>
                                          <div class="d-flex">
                                              <a @click="activate_teacher(teacher.user.id)"
                                                  class="btn btn-success shadow btn-sm sharp mr-1"><i
                                                      class="fa fa-check text-white"></i></a>
                                          </div>
                                      </td>
                                  </tr>

                              </tbody>
                          </table>
                      </div>
                  </div>
                  <div class="card-footer">
                      <vue-pagination :total-items="teachers.total" :page="page" :loading="loading_teachers"
                          :items-per-page="teachers.per_page" v-on:page-change="pageChange">
                      </vue-pagination>
                  </div>
              </div>
          </div>
      </div>

   <div class="modal fade teacher-details-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Teacher Details</h5>
                    <button type="button" class="modal fade" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="containe">
                        <div class="d-flex align-items-center text-center">
                            <img :src="teacher.full_image_path" class="rounded-lg mr-2 text-center" width="114" alt=""/>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Full Name</h5>
                                <p class="mb-4">@{{teacher.full_name_text}}</p>

                                <h5>Gender</h5>
                                <p class="mb-4">@{{teacher.gender}}</p>

                                <h5>Qualification</h5>
                                <p class="mb-4">@{{teacher.qualification}}</p>

                                <h5>Address</h5>
                                <p class="mb-4">@{{teacher.present_address}}</p>

                                <h5>Nationality</h5>
                                <p class="mb-4">@{{teacher.country.name}}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Email</h5>
                                <p class="mb-4">@{{teacher.user.email}}</p>

                                <h5>Date Of Birth</h5>
                                <p class="mb-4">@{{teacher.date_of_birth_text}} | @{{teacher.date_of_birth}}</p>

                                <h5>Religion</h5>
                                <p class="mb-4">@{{teacher.religion}}</p>

                                <h5>State Of Origin</h5>
                                <p class="mb-4">@{{teacher.state.name}} State</p>

                                <h5>Joined</h5>
                                <p class="mb-4">@{{teacher.created_at_text}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
     <script src="{{asset('easy_school/admin/plugins/pages/all-teachers.js')}}"></script>
@endsection
