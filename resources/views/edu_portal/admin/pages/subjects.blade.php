@extends('edu_portal.admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add Subjects</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Academics</a></li>
                        <li class="breadcrumb-item active">Subjects</li>
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
                            <h4>Subjects</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="d-block fs-16">Select Institution</span>
                            <v-select :options="institutions" label="name" v-model="selected_institution" :reduce="institutions => institutions.id" @input="get_subjects" id="institution"></v-select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <label for="level">Select Class</label>
                    <v-select :options="levels" label="name" v-model="selected_level" :reduce="levels => levels.id" id="classes"></v-select>

                    <label id="name" class="mt-3">Subject Label</label>
                    <input class="form-control form-control-sm mb-3" type="text" v-model="label"/>

                    <label id="name">Subject Name</label>
                    <input class="form-control form-control-sm mb-3" type="text" v-model="name"/>

                    <label id="code">Subject Code</label>
                    <input class="form-control form-control-sm" type="text" v-model="subject_code" placeholder="Example MTH"/>

                    <button class="btn btn-primary btn-sm btn-block mt-3" @click="save_subject">
                        <i class="fa fa-paper-plane"></i> Save Subject
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Subjects
                </div>
                <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Subject Code</strong></th>
                                    <th><strong>Subject Name</strong></th>
                                    <th><strong>Subject General Label</strong></th>
                                    <th><strong>Subject Class</strong></th>
                                    <th><strong>Created at</strong></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(subject, index) in subjects.data">
                                    <td><strong>@{{index + 1}}</strong></td>
                                    <td>@{{subject.subject_code}}</td>
                                    <td>@{{subject.name}}</td>
                                    <td>@{{ subject.label }}</td>
                                    <td>@{{ subject.level.name }}</td>
                                    <td>@{{subject.created_at_text}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-sm sharp mr-1" @click="update_subject(subject.id)"><i class="fa fa-pen"></i></a>
                                            <!-- <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a> -->
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <vue-pagination
                        :total-items="subjects.total"
                        :page="page"
                        :loading="loading_subjects"
                        :items-per-page="subjects.per_page"
                        v-on:page-change="pageChange"
                    >
                    </vue-pagination>
                </div>
            </div>
        </div>
     </div>




     <div class="modal fade update_subject" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Subject</h5>
                </div>
                <div class="modal-body">
                    <label for="level">Update Class</label>
                    <v-select :options="levels" label="name" v-model="selected_level" :reduce="levels => levels.id" id="classes"></v-select>

                    <label id="name" class="mt-3">Update Subject Label</label>
                    <input class="form-control form-control-sm mb-3" type="text" v-model="subject.label"/>

                    <label id="name">Update Subject Name</label>
                    <input class="form-control form-control-sm mb-3" type="text" v-model="subject.name"/>

                    <label id="code">Update Subject Code</label>
                    <input class="form-control form-control-sm" type="text" v-model="subject.subject_code" placeholder="Example MTH"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="save_update_changes(subject.id)">Update changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('easy_school/admin/plugins/pages/subjects.js')}}"></script>
@endsection
