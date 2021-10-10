@extends('easy_school.admin.layouts.app')



@section('content')

<div class="text-center" v-show="loading">
    <i class="fa fa-spinner fa-spin fa-5x text-primary"></i>
</div>

<div class="container-fluid" v-show="content">
     <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">School Classes</h2>
            <p class="mb-0">Add A Class</p>
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
                    <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_items" id="institution"></v-select>
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

                    <label class="mt-3" for="class_code">Class Code</label>
                    <input class="form-control form-control-sm" type="text" placeholder="example jss 2" v-model="code"/>

                    <button class="btn btn-sm btn-primary mt-3 btn-block" @click="save_class">
                        <i class="fa fa-paper-plane"></i> Add Class
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Classes
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Class Name</strong></th>
                                    <th><strong>Class Code</strong></th>
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
                                    <td>@{{ level.code }}</td>
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
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="teacher">Update Assigned Teacher</label>
                    <v-select :options="teachers" label="full_name_text" v-model="update_selected_teacher" :reduce="teachers => teachers.id" id="teacher"></v-select>

                    <label class="mt-3" for="class_name">Update Class Name</label>
                    <input class="form-control form-control-sm" type="text" placeholder="example jss 2 science" v-model="level.name"/>

                    <label class="mt-3" for="class_name">Update Class Code</label>
                    <input class="form-control form-control-sm" type="text" placeholder="example jss 2" v-model="level.code"/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="update_class(level.id)" :disabled="isNaN(update_selected_teacher)"><i class="fa fa-paper-plane"></i> Update changes</button>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/classes.js')}}"></script>
@endsection
