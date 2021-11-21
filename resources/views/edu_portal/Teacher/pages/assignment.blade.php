@extends('edu_portal.teacher.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Assignments </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Class Assignments</a></li>
                    <!-- <li class="breadcrumb-item active">Starter Page</li> -->
                </ol>
            </div>
        </div>
    </div>
</div>

  <div class="row">
      <div class="col-md-3">
          <div class="card shadow-lg">
              <div class="card-header">
                  Add Assignments
              </div>
              <div class="card-body">
                  <label class="mt-3">Select Class</label>
                  <v-select :options="levels" label="name" v-model="selected_level" :reduce="levels => levels.id"
                      @input="get_subjects" id="institution">
                  </v-select>


                  <label class="mt-3">Select Session</label>
                  <v-select :options="sessions" label="name" v-model="selected_session"
                      :reduce="sessions => sessions.id" @input="get_term" id="session">
                  </v-select>


                  <label class="mt-3">Select Term</label>
                  <v-select :options="terms" label="name" v-model="selected_term" :reduce="terms => terms.id" id="term">
                  </v-select>

                  <label class="mt-3">Select Subject</label>
                  <v-select :options="subjects" label="name" v-model="selected_subject"
                      :reduce="subjects => subjects.id" id="subject">
                  </v-select>

                  <label class="mt-3">Submission Date</label>
                  <input class="form-control form-control-sm" type="date" v-model="submission_date" />

                  <label for="score">Assignment Score</label>
                  <input class="form-control form-control-sm" type="number" v-model="score"
                      placeholder="Assignment Scores" />

                  <label class="mt-3">Upload Assignment File</label>
                  <input class="form-control form-control" type="file" @change="onAssignmentChange" />

                  <button class="btn btn-sm btn-primary mt-3 btn-block" @click="save_assignment">
                      <i class="fa fa-paper-plane"></i> Save Assignment
                  </button>
              </div>
          </div>
      </div>
      <div class="col-md-9">
          <div class="card shadow-lg">
              <div class="card-header">
                  <div class="row">
                      <div class="col-md-12">
                          Assignments
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Academic Session</th>
                                  <th scope="col">Class</th>
                                  <th scope="col">Subject</th>
                                  <th scope="col">Term</th>
                                  <th scope="col">Submission Deadline</th>
                                  <th scope="col">Assignment Score</th>
                                  <th scope="col">Assignment Link</th>
                                  <th scope="col">Created on</th>
                                  <th scope="col"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(assignment, index) in assignments.data">
                                  <td>@{{ index + 1 }}</td>
                                  <td>@{{ assignment.academic_year.name }}</td>
                                  <td>@{{ assignment.level.name }}</td>
                                  <td>@{{ assignment.subject.name }}</td>
                                  <td>@{{ assignment.term.name }}</td>
                                  <td>@{{ assignment.submission_date_text }}</td>
                                  <td>@{{ assignment.score }} marks</td>
                                  <td><a :href="assignment.full_path_link" class="text-primary">Assignment Link</a></td>
                                  <td>@{{ assignment.created_at_text }}</td>
                                  <td>
                                      <button class="btn btn-primary btn-xs" @click="see_submissions(assignment.id)">
                                          Submissions
                                      </button>
                                  </td>

                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="card-footer">
                  <vue-pagination :total-items="assignments.total" :page="page" :loading="loading_assignments"
                      :items-per-page="assignments.per_page" v-on:page-change="pageChange">
                  </vue-pagination>
              </div>
          </div>
      </div>
  </div>


@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/teacher-assignment.js')}}"></script>
@endsection
