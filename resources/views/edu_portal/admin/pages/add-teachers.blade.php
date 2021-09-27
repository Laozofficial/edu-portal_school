@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add Teachers</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Teachers</a></li>
                        <li class="breadcrumb-item active">Add Teachers</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            Add Teacher
                        </div>
                        <div class="col-md-4 text-right">
                            <span class="d-block fs-16">Select Institution</span>
                            <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" id="institution"></v-select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" v-show="server_error_switch">
                        <div v-for="error in server_errors">
                               @{{ error  }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm mb-4" type="text" v-model="first_name"/>
                        </div>
                         <div class="col-md-4">
                            <label for="middle_name">Middle Name</label>
                            <input class="form-control form-control-sm mb-4" type="text" v-model="middle_name"/>
                        </div>
                        <div class="col-md-4">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm mb-4" type="text" v-model="last_name"/>
                        </div>
                        <div class="col-md-4">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm mb-4" type="email" v-model="email"/>
                        </div>
                        <div class="col-md-4">
                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm mb-4" type="number" v-model="phone"/>
                        </div>
                        <div class="col-md-4">
                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm mb-4" type="date" v-model="date_of_birth"/>
                        </div>
                        <div class="col-md-4">
                            <label for="gender">Gender <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="form-control default-select " v-model="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="gender">Qualification <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="form-control default-select " v-model="qualification">
                                    <option value="ssce">SscE</option>
                                    <option value="nce">NCE</option>
                                    <option value="national diploma">National Diploma</option>
                                    <option value="higher national diploma">Higher National Diploma</option>
                                    <option value="bachelor">BSc</option>
                                    <option value="master degree">MSc</option>
                                    <option value="doctorate">PhD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="gender">Religion <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="form-control default-select " v-model="religion">
                                    <option value="Christianity">Christianity</option>
                                    <option value="islam">Islam</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <span class="d-block fs-16">State of Origin <span class="text-danger">*</span></span>
                            <v-select :options="states" label="name" v-model="selected_state" :reduce="states => states.id" id="states"></v-select>
                        </div>
                        <div class="col-md-4">
                            <span class="d-block fs-16">Nationality <span class="text-danger">*</span></span>
                            <v-select :options="countries" label="name" v-model="selected_country" :reduce="countries => countries.id" id="countries"></v-select>
                        </div>
                        <div class="col-md-4">
                            <label for="present_address">Present Address <span class="text-danger">*</span></label>
                            <input class="form-control from-control-sm" type="text" v-model="present_address" id="present_address"/>
                        </div>
                        <div class="col-md-6">
                            <label for="passport_image">Passport Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" @change="onPassportChange">
                                    <label class="custom-file-label" >Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <button class="btn btn-primary ml-3" @click="validate">
                                <i class="fa fa-paper-plane"></i> Save Teacher Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>


@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/add-teacher.js')}}"></script>
@endsection
