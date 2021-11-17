@extends('easy_school.teacher.layouts.app')

@section('style')
<link href="{{ asset('easy_school/admin/vendor/summernote/summernote.css') }}" rel="stylesheet">
@endsection


@section('content')

<div class="text-center" v-show="loading" id="page_loader">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content" id="show_content">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Staff Leave</h2>
            <!-- <p class="mb-0">m</p> -->
        </div>
        <!-- <div class="dropdown custom-dropdown">
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
                        :reduce="institutions => institutions.id" @input="get_sessions" id="institution"></v-select>
                </div>
                <i class="fa fa-angle-down scale5 ml-3"></i>
            </div>
        </div> -->
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header">Apply For Leave</div>
                <div class="card-body">
                     <div class="alert alert-danger alert-dismissible fade show mt-2" v-show="show_errors">
                         <div v-for="error in errors">
                             <strong>Error!</strong> @{{ error  }}
                         </div>
                         <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"
                             @click="server_errors_switch = false"><span><i class="mdi mdi-close"></i></span>
                         </button>
                     </div>
                    <label for="" class="">Select Academic Session <span class="text-danger">*</span></label>
                     <v-select :options="sessions" label="name" v-model="selected_session"
                         :reduce="sessions => sessions.id" id="session"></v-select>

                     <label for="" class="mt-3">Select Leave Type <span class="text-danger">*</span></label>
                     <v-select :options="leave_types" label="name" v-model="selected_leave_type"
                         :reduce="leave_types => leave_types.id" id="session"></v-select>

                    <label for="" class="mt-3">When Do You Want The Leave <span class="text-danger">*</span></label>
                    <input class="form-control form-control-sm" type="date" v-model="leave_start_date"/>

                    <label for="" class="mt-3">When Is The Leave Going To End <span class="text-danger">*</span></label>
                    <input class="form-control form-control-sm" type="date" v-model="leave_end_date"/>

                    <label for="" class="mt-3">Extra Reasons For The Leave </label>
                    <textarea class="summernote"></textarea>

                    <label for="" class="mt-3">Attach Leave Letter <span class="text-danger">*</span></label>
                    <input class="form-control form-control-sm" type="file" @change="onLeaveLetterChange"/>

                    <button class="btn btn-sm btn-primary btn-block mt-3" @click="apply_for_leave">
                        <i class="fa fa-paper-plane"></i> Apply For Leave
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header">Leave Applications</div>
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
                                     <!-- <th scope="col"></th> -->
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr v-for="(leave, index) in leaves.data">
                                     <th scope="row">@{{ index + 1 }}</th>
                                     <td>@{{ leave.academic_year.name }}</td>
                                     <td>@{{ leave.start_leave_date_text }}</td>
                                     <td>@{{ leave.end_leave_date_text }}</td>
                                     <td><a class="text-primary" :href="leave.leave_attachment_path">Download Leave Attachment</a></td>
                                     <td>@{{ leave.difference_in_days_text }}</td>
                                     <td>@{{ leave.approved_at_text }}</td>
                                     <td :class="leave.status_class_text">@{{ leave.status_text }}</td>
                                     <td>@{{ leave.created_at_text }}</td>
                                     <!-- <td>
                                         <button class="btn btn-xs btn-primary" >
                                             <i class="fa fa-eye"></i>
                                         </button>
                                     </td> -->
                                     <td v-if="leave.status == 0">
                                         <button class="btn btn-xs btn-danger sharp mr-1"
                                             @click="delete_leave(leave.id)">
                                             <i class="fa fa-trash"></i>
                                         </button>
                                     </td>
                                 </tr>
                             </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <vue-pagination :total-items="leaves.total" :page="page" :loading="loading_leaves"
                        :items-per-page="leaves.per_page" v-on:page-change="pageChange">
                    </vue-pagination>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<script src="{{ asset('easy_school/admin/vendor/summernote/js/summernote.min.js') }}"></script>
<script src="{{asset('easy_school/admin/plugins/pages/teacher-staff-leave.js')}}"></script>
@endsection
