@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Update Teacher</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Teacher</a></li>
                        <li class="breadcrumb-item active">Update Teacher</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


     <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Update Teacher
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
                            <input class="form-control form-control-sm mb-4" type="text" v-model="teacher.first_name"/>
                        </div>
                         <div class="col-md-4">
                            <label for="middle_name">Middle Name</label>
                            <input class="form-control form-control-sm mb-4" type="text" v-model="teacher.middle_name"/>
                        </div>
                        <div class="col-md-4">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm mb-4" type="text" v-model="teacher.last_name"/>
                        </div>
                        <div class="col-md-4">
                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm mb-4" type="number" v-model="teacher.user.phone"/>
                        </div>
                        <div class="col-md-4">
                            <label for="gender">Qualification <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select class="form-control default-select " v-model="teacher.qualification">
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
                                <select class="form-control default-select " v-model="teacher.religion">
                                    <option value="Christianity">Christianity</option>
                                    <option value="islam">Islam</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="present_address">Present Address <span class="text-danger">*</span></label>
                            <input class="form-control from-control-sm" type="text" v-model="teacher.present_address" id="present_address"/>
                        </div>
                        <!-- <div class="col-md-4">
                            <label for="passport_image">Passport Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" @change="onPassportChange">
                                    <label class="custom-file-label" >Choose file</label>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-12 mt-5">
                            <button class="btn btn-primary ml-3" @click="validate">
                                <i class="fa fa-paper-plane"></i> Update Teacher Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>


<div class="modal fade image_upload" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Teacher Passport</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label> Upload Teacher Image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" @change="onPassportChange">
                        <label class="custom-file-label" >Choose file</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="upload_image(teacher.slug)">Update changes</button>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
    <script>
        let slug = "{{$slug}}";
    </script>
    <script src="{{asset('easy_school/admin/plugins/pages/update-teacher.js')}}"></script>
@endsection
