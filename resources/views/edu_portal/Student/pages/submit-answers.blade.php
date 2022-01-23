@extends('edu_portal.student.layouts.app')

@section('style')
<link href="{{ asset('easy_school/admin/vendor/summernote/summernote.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Submit Assignment</h4>
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
      <div class="col-md-4">
          <div class="card shadow-lg">
              <div class="card-header">
                  <p class="col-md-6">Assignment Question</p>
                  <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#viewDoc">
                      View Document
                  </button>
              </div>
              <div class="card-body">
                  <h1>Academic Year</h1>
                  <p>- @{{ assignment.academic_year.name }}</p>

                  <h1 class="mt-3">Class</h1>
                  <p>- @{{ assignment.level.name }}</p>

                  <h1 class="mt-3">Subject</h1>
                  <p>- @{{ assignment.subject.name }}</p>

                  <h1 class="mt-3">Submission Date</h1>
                  <p>- @{{ assignment.submission_date_text }}</p>

                  <h1 class="mt-3">Teacher</h1>
                  <p>- @{{ assignment.teacher.full_name_text }}</p>

                  <h1 class="mt-3">Term</h1>
                  <p>- @{{ assignment.term.name }}</p>

                  <h1 class="mt-3">Download Assignment</h1>
                  <p><a :href="assignment.full_path_link" class="text-primary">- Download Assignment</a></p>
              </div>
          </div>
      </div>
      <div class="col-md-8">
          <div class="card shadow-lg">
              <div class="card-header">
                  Submit Assignment
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <label for="">Write out the solution</label>
                          <textarea class="summernote"></textarea>
                      </div>
                      <div class="col-md-8">
                          <h1 class="text-center mt-5">OR</h1>
                          <label class="mt-5">Upload the Assignment - <span class="text-danger">must be in
                                  .docx,.txt,.pdf Forma</span></label>
                          <input class="form-control form-control-sm form-control-file" type="file"
                              @change="onAssignmentChange" />
                      </div>
                  </div>
                  <button class="mt-3 btn btn-primary btn-sm" @click="submit_assignment">
                      <i class="fa fa-paer-plane"></i> Submit Assignment
                  </button>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="viewDoc" data-backdrop="static" data-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Document Viewer</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <iframe :src="assignment.full_path_link" height="500" width="100%" style="width: 100%"></iframe>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>


@endsection
@section('script')
<script>
    let assignment = {!! json_encode($assignment) !!};
    // console.log(assignment);
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
    integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
</script>
<script src="{{ asset('easy_school/admin/vendor/summernote/js/summernote.min.js') }}"></script>
<script src="{{asset('easy_school/admin/plugins/pages/student-submit_answers.js')}}"></script>
@endsection
