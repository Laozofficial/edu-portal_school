@extends('admin.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
     <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">School Terms</h2>
            <p class="mb-0">Add A Term</p>
        </div>
        <div class="dropdown custom-dropdown">
            <div class="btn btn-sm btn-primary light d-flex align-items-center svg-btn" data-toggle="dropdown">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path d="M22.4281 2.856H21.8681V1.428C21.8681 0.56 21.2801 0 20.4401 0C19.6001 0 19.0121 0.56 19.0121 1.428V2.856H9.71606V1.428C9.71606 0.56 9.15606 0 8.28806 0C7.42006 0 6.86006 0.56 6.86006 1.428V2.856H5.57206C2.85606 2.856 0.560059 5.152 0.560059 7.868V23.016C0.560059 25.732 2.85606 28.028 5.57206 28.028H22.4281C25.1441 28.028 27.4401 25.732 27.4401 23.016V7.868C27.4401 5.152 25.1441 2.856 22.4281 2.856ZM5.57206 5.712H22.4281C23.5761 5.712 24.5841 6.72 24.5841 7.868V9.856H3.41606V7.868C3.41606 6.72 4.42406 5.712 5.57206 5.712ZM22.4281 25.144H5.57206C4.42406 25.144 3.41606 24.136 3.41606 22.988V12.712H24.5561V22.988C24.5841 24.136 23.5761 25.144 22.4281 25.144Z" fill="#2F4CDD"></path>
                    </g>
                </svg>
                <div class="text-left ml-3">
                    <span class="d-block fs-16">Select Institution</span>
                    <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" id="institution"></v-select>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Add Teacher
                </div>
                <div class="card-body">
                    <div class="alert alert-danger alert-dismissible fade show mt-2" v-show="server_error_switch">
                        <div v-for="error in server_errors">
                                <strong>Error!</strong> @{{ error  }}
                        </div>
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
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
                        <div class="col-md-4">
                            <label for="passport_image">Passport Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" @change="onPassportChange">
                                    <label class="custom-file-label" >Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <button class="btn btn-primary ml-3 btn-lg" @click="validate">
                                <i class="fa fa-paper-plane"></i> Save Teacher Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>

</div>

@endsection
@section('script')
    <script src="{{asset('admin/plugins/pages/add-teacher.js')}}"></script>
@endsection
