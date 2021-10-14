@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Student Information</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Student</a></li>
                        <li class="breadcrumb-item active">Student Information</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


      <div class="row">
         <div class="col-md-6">
             <div class="card shadow-lg">
                <div class="card-header">
                    Student Details
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
                       <div class="col-md-6 text-right">
                            Parents
                       </div>
                       <div class="col-md-6 ml-4 text-right">
                           <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target=".add_parent">
                               <i class="fa fa-plus"></i> add parent
                           </button>
                       </div>
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
                                    <td>
                                        <button class="btn btn-sm btn-primary" @click="update_parent(parent.id)">
                                            <i class="fa fa-pen"></i>
                                        </button>
                                    </td>
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
                                    <th></th>
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
                                    <td>
                                        <button class="btn btn-sm btn-primary" @click="update_score(assessment.id)">
                                            <i class="fa fa-pen"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <vue-pagination
                        :total-items="assessments.total"
                        :page="page"
                        :loading="loading_assessments"
                        :items-per-page="assessments.per_page"
                        v-on:page-change="pageChange"
                    >
                    </vue-pagination>
                </div>
            </div>
         </div>
     </div>


     <div class="modal fade" id="update_score">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Assessment Score</h5>
                </div>
                <div class="modal-body p-lg-5">
                    <label>Enter New Score</label>
                    <input class="form-control form-controm-sm" type="text" v-model="assessment.score"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="update_assessment_score" :disabled="assessment.score == ''">Update Score</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade add_parent" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Guardian To the Student</h5>
                </div>
                <div class="modal-body">
                    <div v-for="error in errors" class="mb-4 col-md-12 container">
                        <div class="alert alert-danger alert-dismissible fade show" v-show="server_errors">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                <strong>Error!</strong> @{{error}}
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                            </button>
                        </div>
                    </div>

                    <label class="mt-4">Full Name</label>
                    <input class="form-control form-control-sm" type="text" v-model="parent.full_name"/>

                    <label class="mt-4">Email</label>
                    <input class="form-control form-control-sm" type="text" v-model="parent.email"/>

                    <label class="mt-4">Phone Number</label>
                    <input class="form-control form-control-sm" type="text" v-model="parent.phone"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="add_parent">Save changes</button>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade update_parent" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Guardian To the Student</h5>
                </div>
                <div class="modal-body">
                    <label class="mt-4">Full Name</label>
                    <input class="form-control form-control-sm" type="text" v-model="single_parent.user.name"/>

                    <label class="mt-4">Phone Number</label>
                    <input class="form-control form-control-sm" type="text" v-model="single_parent.user.phone"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="update_single_parent">Save changes</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script>
        let id = "{{ $id }}";
    </script>
    <script src="{{asset('easy_school/admin/plugins/pages/student-details.js')}}"></script>
@endsection
