@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add Classes</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Academics</a></li>
                        <li class="breadcrumb-item active">Class</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

   <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add Class
                </div>
                <div class="card-body">
                    <label for="teacher">Assign Teacher</label>
                    <v-select :options="teachers" label="full_name_text" v-model="selected_teacher" :reduce="teachers => teachers.id" id="teacher"></v-select>

                    <label class="mt-3" for="class_name">Class Name</label>
                    <input class="form-control form-control-sm" type="text" placeholder="example jss 2 science" v-model="name"/>

                    <button class="btn btn-sm btn-primary mt-3 btn-block" @click="save_class">
                        <i class="fa fa-paper-plane"></i> Add Class
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Classes
                        </div>
                        <div class="col-md--6 text-right">
                            <span class="d-block fs-16">Select Institution</span>
                            <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_items" id="institution"></v-select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Class Name</strong></th>
                                    <th><strong>Teacher</strong></th>
                                    <th><strong>status</strong></th>
                                    <th><strong>created at</strong></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(level, index) in levels.data">
                                    <td><strong>@{{index + 1}}</strong></td>
                                    <td>@{{level.name}}</td>
                                    <td>@{{level.teacher.full_name_text}}</td>
                                    <td v-if="level.status == 0"><span class="badge light badge-success">@{{level.status_text}}</span></td>
                                    <td v-if="level.status == 1"><span class="badge light badge-error">@{{level.status_text}}</span></td>
                                    <td>@{{level.created_at_text}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1" @click="edit_school(level.id)"><i class="fa fa-pencil"></i></a>
                                            <!-- <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a> -->
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-danger shadow btn-xs " @click="see_students(level.id)">
                                                <i class="fa fa-eye"></i> Enrolled Students
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                     <vue-pagination
                        :total-items="levels.total"
                        :page="page"
                        :loading="loading_levels"
                        :items-per-page="levels.per_page"
                        v-on:page-change="pageChange"
                    >
                    </vue-pagination>
                </div>
            </div>
        </div>
     </div>


     <div class="modal fade update_class" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Class</h5>
                </div>
                <div class="modal-body">
                    <label for="teacher">Update Assigned Teacher</label>
                    <v-select :options="teachers" label="full_name_text" v-model="update_selected_teacher" :reduce="teachers => teachers.id" id="teacher"></v-select>

                    <label class="mt-3" for="class_name">Update Class Name</label>
                    <input class="form-control form-control-sm" type="text" placeholder="example jss 2 science" v-model="level.name"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="update_class(level.id)" :disabled="isNaN(update_selected_teacher)"><i class="fa fa-paper-plane"></i> Update changes</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/classes.js')}}"></script>
@endsection
