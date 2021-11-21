@extends('edu_portal.teacher.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Assignments Submissions</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Submissions</a></li>
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
                 Assignment Submissions
             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table">
                         <table class="table table-sm">
                             <thead>
                                 <tr>
                                     <th style="width:80px;"><strong>#</strong></th>
                                     <th><strong>Student Name</strong></th>
                                     <th><strong>Assignment Path</strong></th>
                                     <th><strong>Assignment Written</strong></th>
                                     <th><strong>Score</strong></th>
                                     <th><strong>Submitted On</strong></th>
                                     <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr v-for="(submission, index) in submissions.data">
                                     <td>@{{ index + 1 }}</td>
                                     <td>@{{ submission.student.full_name_text }}</td>
                                     <td v-if="submission.assignment_path_text"><a
                                             :href="submission.assignment_path_text">Download Assignment</a>
                                     </td>
                                     <td v-else>it's Written Assignment</td>
                                     <td v-if="submission.assignment_solution_written">
                                         <button class="btn btn-sm btn-success">
                                             <i class="fa fa-eye"></i> View Assignment
                                         </button>
                                     </td>
                                     <td>@{{ submission.score }} Marks</td>
                                     <td>@{{ submission.submission.date_text }}</td>
                                     <td>
                                         <div class="d-flex">
                                             <a href="#" class="btn btn-danger shadow btn-xs sharp mr-1"
                                                 @click="score_assignment(submission.id)"><i
                                                     class="fa fa-trash text-white"></i></a>
                                         </div>
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </table>
                 </div>
             </div>
             <div class="card-footer">

             </div>
         </div>
     </div>
 </div>




 <div class="modal fade" id="record_assignment">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Record Assessment</h5>
             </div>
             <div class="modal-body">

                 <label for="" class="mt-3">Enter Assignment Score</label>
                 <input class="form-control form-control-sm" type="number" v-model="score" placeholder="Enter Score" />

             </div>
             <div class="modal-footer">
                <div id="modal-close-library"></div>
                <button type="button" class="btn btn-primary" @click="store_score">Record Score for
                     @{{ submission.student.full_name_text }}</button>
             </div>
         </div>
     </div>
 </div>


@endsection
@section('script')
<script>
    let id = "{{ $id }}"
</script>
<script src="{{asset('easy_school/admin/plugins/pages/teacher_submission.js')}}"></script>
@endsection
