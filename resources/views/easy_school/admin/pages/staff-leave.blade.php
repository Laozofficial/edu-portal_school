@extends('easy_school.admin.layouts.app')



@section('content')
<div class="text-center" v-show="loading" id="page_loader">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content" id="show_content">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">School Terms</h2>
            <p class="mb-0">Add A Term</p>
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
                    <span class="d-block fs-16">Select Institution</span>
                    <v-select :options="institutions" label="name" v-model="selected_institution"
                        :reduce="institutions => institutions.id" @input="get_leave_applications" id="institution"></v-select>
                </div>
                <i class="fa fa-angle-down scale5 ml-3"></i>
            </div>
            <!-- <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">4 June 2020 - 4 July 2020</a>
                <a class="dropdown-item" href="#">5 july 2020 - 4 Aug 2020</a>
            </div> -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    Staff Leave Application
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
                                       <td>
                                           <button class="btn btn-xs sharp mr-1 btn-primary" @click="leave_details(leave.id)">
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
                            <select class="mr-sm-2 default-select form-control" id="inlineFormCustomSelect" v-model="update_leave_status">
                                <option selected>Choose...</option>
                                <option value="1">Approve</option>
                                <option value="2">Declined</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>When Should The Staff Return ></label>
                            <input class="form-control form-control-sm" type="date" :readonly="update_leave_status == '1'" v-model="application.end_leave_date"/>
                             <small id="emailHelp" class="form-text text-muted">What date should the staff return ?</small>
                        </div>
                    </div>


                    <label class="mb-4">Staff Extra Leave Note</label>
                    <div v-html="application.leave_reason"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-xs" @click="update_application">Update Application</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<script src="{{asset('easy_school/admin/plugins/pages/staff-leave.js')}}"></script>
@endsection
