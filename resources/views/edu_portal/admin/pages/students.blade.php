@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Students</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Students</a></li>
                        <!-- <li class="breadcrumb-item active">Starter Page</li> -->
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
                            <h4>Students</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="d-block fs-16">Select Institution</span>
                            <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_students" id="institution"></v-select>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <div class="col-lg-12">
                        <div class="cad">
                            <div class="card-ody">
                                <div class="row">
                                    <div class="col-md-4 pr-0">
                                        <input class="form-control form-control-sm pr-0" placeholder="search student by first or last name " type="text" style="height: 30px" v-model="q"/>
                                    </div>
                                    <div class="col-md-4 pl-1">
                                        <button class="btn btn-sm btn-info pl-1" style="height: 28px; border-radius: 0 !important" @click="search_student"><i class="fa fa-search" style="height: 28px; "></i> search</button>
                                    </div>
                                </div>
                               <div class="table table-sm mt-3">
                                    <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th><strong>S/N</strong></th>
                                                <th><strong>Student Name</strong></th>
                                                <th><strong>Email</strong></th>
                                                <th><strong>Gender</strong></th>
                                                <th><strong>State</strong></th>
                                                <th><strong>Current Class</strong></th>
                                                <th><strong>Joined</strong></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(student, index) in students.data">
                                                <td><strong>@{{index + 1}}</strong></td>
                                                <td>@{{student.full_name_text}}</td>
                                                <td><div class="d-flex align-items-center">
                                                    <span class="w-space-no">@{{student.user.email}}</span></div>
                                                </td>
                                                <td>@{{ student.gender }}	</td>
                                                <td><div class="d-flex align-items-center"> @{{student.state.name}} state</div> </td>
                                                <td v-if="student.level !== null"> <i class="fa fa-circle text-success mr-1"></i> @{{  student.level.name }}</td>
                                                <td v-else><i class="fa fa-circle text-danger mr-1"></i> Not Assigned</td>
                                                <td>@{{ student.created_at_text }}</td>
                                                 <td>
													<div class="d-flex">
														<a @click="view_student(student.id)" class="btn btn-primary shadow btn-sm sharp mr-1"><i class="fa fa-pen text-white"></i></a>
													</div>
												</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm shadow" @click="assign_to_class(student.id)">
                                                        <i class="fa fa-tasks"></i>  assign to class
                                                    </button>
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
                <div class="card-footer">
                     <vue-pagination
                        :total-items="students.total"
                        :page="page"
                        :loading="loading_students"
                        :items-per-page="students.per_page"
                        v-on:page-change="pageChange"
                    >
                    </vue-pagination>
                </div>
            </div>
        </div>
     </div>


    <div class="modal fade" id="assign-class">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Student To class</h5>n>&times;</span>
                </div>
                <div class="modal-body p-lg-5">
                    <label>Select Class</label>
                    <v-select :options="classes" label="name" v-model="selected_class" :reduce="levels => levels.id"  id="levels"></v-select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="assign_class" :disabled="isNaN(selected_class)">Assign Class to @{{ student.first_name }}</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/students.js')}}"></script>
@endsection
