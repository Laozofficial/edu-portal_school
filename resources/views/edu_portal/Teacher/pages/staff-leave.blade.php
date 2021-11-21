@extends('edu_portal.teacher.layouts.app')

@section('content')

@section('style')
<link href="{{ asset('easy_school/admin/vendor/summernote/summernote.css') }}" rel="stylesheet">
@endsection


<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Staff Leave</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Leave Application</a></li>
                    <!-- <li class="breadcrumb-item active">Starter Page</li> -->
                </ol>
            </div>
        </div>
    </div>
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
                 <v-select :options="sessions" label="name" v-model="selected_session" :reduce="sessions => sessions.id"
                     id="session"></v-select>

                 <label for="" class="mt-3">Select Leave Type <span class="text-danger">*</span></label>
                 <v-select :options="leave_types" label="name" v-model="selected_leave_type"
                     :reduce="leave_types => leave_types.id" id="session"></v-select>

                 <label for="" class="mt-3">When Do You Want The Leave <span class="text-danger">*</span></label>
                 <input class="form-control form-control-sm" type="date" v-model="leave_start_date" />

                 <label for="" class="mt-3">When Is The Leave Going To End <span class="text-danger">*</span></label>
                 <input class="form-control form-control-sm" type="date" v-model="leave_end_date" />

                 <label for="" class="mt-3">Extra Reasons For The Leave </label>
                 <textarea class="summernote"></textarea>

                 <label for="" class="mt-3">Attach Leave Letter <span class="text-danger">*</span></label>
                 <input class="form-control form-control-sm" type="file" @change="onLeaveLetterChange" />

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
                                 <td><a class="text-primary" :href="leave.leave_attachment_path">Download Leave
                                         Attachment</a></td>
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
                                     <button class="btn btn-xs btn-danger sharp mr-1" @click="delete_leave(leave.id)">
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


@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
    integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
</script>

<script src="{{ asset('easy_school/admin/vendor/summernote/js/summernote.min.js') }}"></script>
<script src="{{asset('easy_school/admin/plugins/pages/teacher-staff-leave.js')}}"></script>
@endsection
