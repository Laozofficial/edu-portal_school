@extends('edu_portal.admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Add School</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Staff Leave</a></li>
                    <li class="breadcrumb-item active">Leave Applications</li>
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
                          Staff Leave Application
                     </div>
                     <div class="col-md-6 text-right">
                         <span class="d-block fs-16">Select Institution</span>
                         <v-select :options="institutions" label="name" v-model="selected_institution"
                             :reduce="institutions => institutions.id" @input="get_leave_applications" id="institution">
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
                                  <th scope="col">Academic Session</th>
                                  <th scope="col">Leave Start Date</th>
                                  <th scope="col">Leave End Date</th>
                                  <th scope="col">Attachment Letter</th>
                                  <th scope="col">Leave Days</th>
                                  <th scope="col">Approved On</th>
                                  <th scope="col">status</th>
                                  <th scope="col">Submitted </th>
                                  <th scope="col"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(leave, index) in leaves.data">
                                  <th scope="row">@{{ index + 1 }}</th>
                                  <td>@{{ leave.academic_year.name }}</td>
                                  <td>@{{ leave.start_leave_date_text }}</td>
                                  <td>@{{ leave.end_leave_date_text }}</td>
                                  <td><a class="text-primary" :href="leave.leave_attachment_path">Download Leave
                                          Attachment</a></td>
                                  <td>@{{ leave.difference_in_days_text }}</td>
                                  <td>@{{ leave.approved_at_text }}</td>
                                  <td :class="leave.status_class_text">@{{ leave.status_text }}</td>
                                  <td>@{{ leave.created_at_text }}</td>
                                  <td v-if="leave.status == '0'">
                                      <button class="btn btn-xs sharp mr-1 btn-primary"
                                          @click="leave_details(leave.id)">
                                          <i class="fa fa-pencil"></i>
                                      </button>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="card-footer">
                  <vue-pagination :total-items="leaves.total" :page="page" :loading="loading_applications"
                      :items-per-page="leaves.per_page" v-on:page-change="pageChange">
                  </vue-pagination>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="leave_details" data-backdrop="static" data-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Leave Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row mb-3" v-if="application.status == 0">
                      <div class="col-md-6">
                          <label>Change Leave Status</label>
                          <select class="mr-sm-2 default-select form-control" id="inlineFormCustomSelect"
                              v-model="update_leave_status">
                              <option selected>Choose...</option>
                              <option value="1">Approve</option>
                              <option value="2">Declined</option>
                          </select>
                      </div>
                      <div class="col-md-6">
                          <label>When Should The Staff Return ></label>
                          <input class="form-control form-control-sm" type="date"
                              :disabled="update_leave_status == '' || update_leave_status == '2'"
                              v-model="application.end_leave_date" />
                          <small id="emailHelp" class="form-text text-muted">What date should the staff return ?</small>
                      </div>
                  </div>


                  <label class="mb-4">Staff Extra Leave Note</label>
                  <div v-html="application.leave_reason"></div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-xs" @click="update_application">Update
                      Application</button>
              </div>
          </div>
      </div>
  </div>


@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/staff-leave.js')}}"></script>
@endsection
