@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add Student</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Student</a></li>
                        <li class="breadcrumb-item active">Add Student</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


      <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <div class="row">
                       <div class="col-md-6">

                       </div>
                       <div class="col-md-6">
                           <span class="d-block fs-16">Select Institution</span>
                           <v-select :options="institutions" label="name" v-model="selected_institution"
                               :reduce="institutions => institutions.id" id="institution"></v-select>
                       </div>
                   </div>
                </div>
                <div class="card-body">
                    <div v-for="error in errors" class="mb-4 col-md-12 container">
                        <div class="alert alert-danger alert-dismissible fade show" v-show="errors_switch">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                <strong>Error!</strong> @{{error}}
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="country">Select Student Country <span class="text-danger">*</span></label>
                            <v-select :options="countries" label="name" v-model="selected_country" :reduce="countries => countries.id" id="country"></v-select>
                        </div>

                        <div class="col-md-4">
                            <label for="state">Select Student State <span class="text-danger">*</span></label>
                            <v-select :options="states" label="name" v-model="selected_state" :reduce="states => states.id" id="states"></v-select>
                        </div>

                        <div class="col-md-4">
                           <label for="passport_image">Passport Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" @change="onPassportChange">
                                    <label class="custom-file-label" >Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="first_name" class="mt-4">First Name</label>
                            <input class="form-control form-control-sm mb-4" type="text" v-model="first_name" id="first_name" placeholder="First Name"/>
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="mt-4">Last Name</label>
                            <input class="form-control form-control-sm mb-4" type="text" v-model="last_name" id="last_name" placeholder="Last Name"/>
                        </div>

                        <div class="col-md-4">
                            <label for="middle_name" class="mt-4">Middle Name</label>
                            <input class="form-control form-control-sm mb-4" type="text" v-model="middle_name" id="middle_name" placeholder="Middle Name"/>
                        </div>



                        <div class="col-md-4">
                           <label for="email">Student Email</label>
                           <input class="form-control form-control-sm" type="email" v-model="email">
                        </div>

                        <div class="col-md-4">
                            <label for="address" class="mt-2">Present Address</label>
                            <input class="form-control form-control-sm mb-4" type="text" v-model="present_address" placeholder="Present Address"/>
                        </div>

                        <div class="col-md-4">
                            <label for="city" class="mt-2">City</label>
                            <input class="form-control form-control-sm mb-4" type="text" v-model="city" placeholder="City"/>
                        </div>

                         <div class="col-md-4">
                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm mb-4" type="date" v-model="date_of_birth"/>
                        </div>

                         <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Gender</label>
                                </div>
                                <select class="default-select" v-mode="gender">
                                    <option value="female">Female</option>
                                    <option value="male">Male</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                           <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Religion</label>
                                </div>
                                <select class="default-select" v-mode="religion">
                                    <option value="christian">Christian</option>
                                    <option value="islam">Islam</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <button class="btn btn-sm btn-primary" @click="save_student">
                                <i class="fa fa-paper-plane"></i> Save Student
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
     </div>

@endsection
@section('script')
       <script src="{{asset('easy_school/admin/plugins/pages/add-student.js')}}"></script>
@endsection
