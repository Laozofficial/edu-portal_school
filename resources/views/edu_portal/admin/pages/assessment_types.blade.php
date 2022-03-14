@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Assessment Types</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Assessment Type</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

      <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-lg">
                        <div class="card-header">
                           <div class="row">
                               <div class="col-md-6">
                                   Add Assessment Type
                               </div>
                               <div class="col-md-6 text-right">
                                    <span class="d-block fs-16">Select Institution</span>
                                    <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_assessment_types" id="institution"></v-select>
                               </div>
                           </div>
                        </div>
                        <div class="card-body">
                            <label for="name">Name</label>
                            <input class="form-control form-control-sm mb-3" type="text" id="name" v-model="name" placeholder="Example CA TEST"/>

                            <label for="max_mark">Max Mark</label>
                            <input class="form-control form-control-sm mb-3" type="number" id="max_mark" v-model="max_mark" placeholder="Example 60"/>

                            <button class="btn btn-primary btn-sm btn-block" @click="save_assessment_type">
                                <i class="fa fa-paper-plane"></i> Add Assessment Type
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            Assessment Types
                        </div>
                        <div class="card-body">
                              <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>S/N</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Max Mark</strong></th>
                                        <th><strong></strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(type, index) in assessment_types">
                                        <td><strong>@{{index + 1}}</strong></td>
                                        <td>@{{type.name}}</td>
                                        <td>@{{type.max_mark}} marks</td>
                                        <td>
                                            <div class="d-flex">
                                                <a @click="update_type(type.id)" class="btn btn-primary shadow btn-sm sharp mr-1"><i class="fa fa-pen text-white"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>


    <div class="modal fade update_assessment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Assessments</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label id="minimum_mark">Update Assessment Name</label>
                    <input class="form-control form-control-sm mb-3" type="text" v-model="assessment_type.name" placeholder="CA Test"/>

                    <label id="maximum_mark">Update Maximum Mark</label>
                    <input class="form-control form-control-sm mb-4" type="number" v-model="assessment_type.max_mark" placeholder="60"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="save_update_assessment(assessment_type.id)"><i class="fa fa-paper-plane"></i> Update changes</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/assessment_types.js')}}"></script>
@endsection
