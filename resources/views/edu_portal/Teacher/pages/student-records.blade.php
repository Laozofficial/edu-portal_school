@extends('edu_portal.teacher.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Student Records</h4>
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
      <div class="col-md-6">
          <div class="card shadow-lg">
              <div class="card-header">
                  Student Personal Details
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">
                          <h1 class="text-uppercase">Student Full Name</h1>
                          <p class="mb-4"> - @{{ student.full_name_text }}</p>

                          <h1 class="text-uppercase">Date Of Birth</h1>
                          <p class="mb-4"> - @{{ student.date_of_birth }}</p>

                          <h1 class="text-uppercase">Address</h1>
                          <p class="mb-4"> - @{{ student.present_address }}</p>
                      </div>
                      <div class="col-md-6">
                          <h1 class="text-uppercase">State Of Origin</h1>
                          <p class="mb-4"> - @{{ student.state.name }} state</p>

                          <h1 class="text-uppercase">Gender</h1>
                          <p class="mb-4"> - @{{ student.gender }}</p>

                          <h1 class="text-uppercase">Religion</h1>
                          <p class="mb-4"> - @{{ student.religion }}</p>
                      </div>
                  </div>
              </div>
              <div class="card-footer">

              </div>
          </div>
      </div>
      <div class="col-md-6">
          <div class="card shadow-lg">
              <div class="card-header">
                  <div class="row">
                      Parents
                  </div>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-responsive-md">
                          <thead>
                              <tr>
                                  <th style="width:80px;"><strong>#</strong></th>
                                  <th><strong>Full Name</strong></th>
                                  <th><strong>Phone Number</strong></th>
                                  <th><strong>Email</strong></th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(parent, index) in student.parents">
                                  <td><strong>@{{index + 1}}</strong></td>
                                  <td>@{{ parent.user.name }}</td>
                                  <td>@{{ parent.user.phone }}</td>
                                  <td>@{{ parent.user.email }}</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="card-footer">

              </div>
          </div>
      </div>
      <div class="col-md-6">
          <div class="card shadow-lg">
              <div class="card-header">
                  Student Class
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-responsive-md">
                          <thead>
                              <tr>
                                  <th style="width:80px;"><strong>#</strong></th>
                                  <th><strong>Current Class</strong></th>
                                  <th><strong>Teacher</strong></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td><strong>#</strong></td>
                                  <td>@{{ student.level.name }}</td>
                                  <td>@{{ student.level.teacher.user.name }}</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-6">

      </div>
      <div class="col-md-12">
          <div class="card shadow-lg">
              <div class="card-header">
                  Assessments
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-responsive-md">
                          <thead>
                              <tr>
                                  <th style="width:80px;"><strong>#</strong></th>
                                  <th><strong>Academic Year</strong></th>
                                  <th><strong>Assessment Type</strong></th>
                                  <th><strong>Class</strong></th>
                                  <th><strong>Subject</strong></th>
                                  <th><strong>Term</strong></th>
                                  <th><strong>Score</strong></th>
                                  <th><strong>Created at</strong></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(assessment, index) in assessments.data">
                                  <td><strong>@{{index + 1}}</strong></td>
                                  <td>@{{ assessment.academic_year.name }}</td>
                                  <td>@{{ assessment.assessment_type.name }}</td>
                                  <td>@{{ assessment.level.name }}</td>
                                  <td>@{{ assessment.subject.name }}</td>
                                  <td>@{{ assessment.term.name }}</td>
                                  <td>@{{ assessment.score }} mark(s)</td>
                                  <td>@{{ assessment.created_at_text }}</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="card-footer">
                  <vue-pagination :total-items="assessments.total" :page="page" :loading="loading_assessments"
                      :items-per-page="assessments.per_page" v-on:page-change="pageChange">
                  </vue-pagination>
              </div>
          </div>
      </div>
  </div>


@endsection
@section('script')
<script>
    let id = "{{ $id }}";
</script>
<script src="{{asset('easy_school/admin/plugins/pages/teacher-student-records.js')}}"></script>
@endsection
