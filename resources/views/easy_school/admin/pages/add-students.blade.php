@extends('easy_school.admin.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
     <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Add New Student</h2>
            <p class="mb-0">Add new Student</p>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Add Student
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

</div>

@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/add-student.js')}}"></script>
@endsection
