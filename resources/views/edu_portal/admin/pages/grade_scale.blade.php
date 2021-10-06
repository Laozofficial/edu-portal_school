@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add Grade Scale</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Add Grade Scale</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

      <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Add Grade Scale
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="d-block fs-16">Select Institution</span>
                            <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_grades" id="institution"></v-select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <label id="minimum_mark">Minimum Mark</label>
                    <input class="form-control form-control-sm mb-3" type="number" v-model="lower_value" placeholder="70"/>

                    <label id="maximum_mark">Maximum Mark</label>
                    <input class="form-control form-control-sm mb-4" type="number" v-model="upper_value" placeholder="100"/>

                    <label id="grade">Grade</label>
                    <input class="form-control form-control-sm mb-4" type="text" v-model="grade" placeholder="Example A+"/>

                    <button class="btn btn-primary btn-block" @click="save_grade">
                        <i class="fa fa-paper-plane"></i> Add Grade
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Grades
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Grade</strong></th>
                                    <th><strong>From</strong></th>
                                    <th><strong>To</strong></th>
                                    <th><strong>Created at</strong></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(grade, index) in grades">
                                    <td><strong>@{{index + 1}}</strong></td>
                                    <td>@{{grade.grade}}</td>
                                    <td>@{{grade.lower_value}}</td>
                                    <td>@{{grade.upper_value}}</td>
                                    <td>@{{grade.created_at_text}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-sm sharp mr-1" @click="edit_grade(grade.id)"><i class="fa fa-pen"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-sm btn-danger shadow btn-xs sharp mr-1" @click="delete_grade(grade.id)"><i class="fa fa-trash"></i></a>
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


    <div class="modal fade update_grade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Grade</h5>
                </div>
                <div class="modal-body">
                    <label id="minimum_mark">Update Minimum Mark</label>
                    <input class="form-control form-control-sm mb-3" type="number" v-model="single_grade.lower_value" placeholder="70"/>

                    <label id="maximum_mark">Update Maximum Mark</label>
                    <input class="form-control form-control-sm mb-4" type="number" v-model="single_grade.upper_value" placeholder="100"/>

                    <label id="grade">Grade</label>
                    <input class="form-control form-control-sm mb-4" type="text" v-model="single_grade.grade" placeholder="Example A+"/>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="save_update_grade(single_grade.id)"><i class="fa fa-paper-plane"></i> Update changes</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/grade_scale.js')}}"></script>
@endsection
